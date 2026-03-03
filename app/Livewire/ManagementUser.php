<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ManagementUser extends Component
{
    use \Livewire\WithFileUploads;
    use \Livewire\WithPagination;

    public $name;

    public $email;

    public $phone;

    public $role;

    public $status;

    public $password;

    public $avatar;

    public $existingAvatar;

    public $userId;

    public $isOpen = false;

    public $isEdit = false;

    public $search = '';

    public $filterRole = '';

    public $filterStatus = '';

    public $filterTrashed = '';

    public $sortOrder = 'latest';

    public $selectedUsers = [];

    public $selectAll = false;

    // Listeners for events triggered from the frontend
    protected $listeners = ['deleteConfirmed' => 'delete', 'bulkDeleteConfirmed' => 'bulkDelete', 'deleteUser', 'restoreConfirmed' => 'restore', 'forceDeleteConfirmed' => 'forceDelete'];

    private function getUsersQuery()
    {
        return \App\Models\User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterRole, function ($query) {
                $query->where('role', $this->filterRole);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterTrashed === 'with_trashed', function ($query) {
                $query->withTrashed();
            })
            ->when($this->filterTrashed === 'only_trashed', function ($query) {
                $query->onlyTrashed();
            });
    }

    public function render()
    {
        $users = $this->getUsersQuery()
            ->when($this->sortOrder === 'oldest', function ($query) {
                $query->oldest();
            }, function ($query) {
                $query->latest();
            })
            ->paginate(10);

        return view('livewire.management-user', [
            'users' => $users,
        ])->layout('layouts.app');
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->filterRole = '';
        $this->filterStatus = '';
        $this->filterTrashed = '';
        $this->sortOrder = 'latest';
        $this->resetPage();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
        $this->isOpen = true;
        // Dispatch event to open modal via Alpine
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'status' => 'required',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
        }

        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'password' => Hash::make($this->password),
            'avatar' => $avatarPath,
        ]);

        $this->hideModal();
        $this->dispatch('toast-success', [
            'title' => 'Success',
            'message' => 'User created successfully!',
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->existingAvatar = $user->avatar;

        $this->isEdit = true;
        $this->isOpen = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'role' => 'required',
            'status' => 'required',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = \App\Models\User::findOrFail($this->userId);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
        ];

        if ($this->avatar) {
            if ($user->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }

        if (! empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        $this->hideModal();
        $this->dispatch('toast-success', [
            'title' => 'Success',
            'message' => 'User updated successfully!',
        ]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        \App\Models\User::destroy($id);
        $this->selectedUsers = array_diff($this->selectedUsers, [$id]);

        $this->dispatch('toast-success', [
            'title' => 'Success',
            'message' => 'Data deleted successfully!',
        ]);
    }

    // Helper to receive ID from event
    public function deleteUser($id)
    {
        $this->delete($id);
    }

    public function restore($id)
    {
        $user = \App\Models\User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            $user->restore();
            $this->dispatch('toast-success', [
                'title' => 'Success',
                'message' => 'User restored successfully!',
            ]);
        }
    }

    public function forceDelete($id)
    {
        $user = \App\Models\User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            $user->forceDelete();
            $this->selectedUsers = array_diff($this->selectedUsers, [$id]);
            $this->dispatch('toast-success', [
                'title' => 'Success',
                'message' => 'User deleted permanently!',
            ]);
        }
    }

    public function bulkDelete()
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        DB::beginTransaction();
        try {
            $count = count($this->selectedUsers);

            // Validate that we only delete non-trashed users
            $validCount = \App\Models\User::whereIn('id', $this->selectedUsers)->count();
            if ($validCount !== $count) {
                throw new \Exception('Some selected users are not valid for deletion.');
            }

            \App\Models\User::whereIn('id', $this->selectedUsers)->delete();

            $this->selectedUsers = [];
            $this->selectAll = false;

            DB::commit();
            $this->dispatch('toast-success', [
                'title' => __('success'),
                'message' => $count.' '.__('users_deleted'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk delete failed', ['error' => $e->getMessage()]);
            $this->dispatch('toast-error', [
                'title' => __('error'),
                'message' => 'Bulk delete failed. Please try again.',
            ]);
        }
    }

    public function bulkRestore()
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        DB::beginTransaction();
        try {
            $count = count($this->selectedUsers);

            // Validate that we only restore trashed users
            $trashedCount = \App\Models\User::onlyTrashed()->whereIn('id', $this->selectedUsers)->count();
            if ($trashedCount !== $count) {
                throw new \Exception('Some selected users are not in trash.');
            }

            \App\Models\User::withTrashed()->whereIn('id', $this->selectedUsers)->restore();

            $this->selectedUsers = [];
            $this->selectAll = false;

            DB::commit();
            $this->dispatch('toast-success', [
                'title' => __('success'),
                'message' => $count.' '.__('users_restored') ?? 'Users restored successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk restore failed', ['error' => $e->getMessage()]);
            $this->dispatch('toast-error', [
                'title' => __('error'),
                'message' => 'Bulk restore failed. Please try again.',
            ]);
        }
    }

    public function bulkForceDelete()
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        DB::beginTransaction();
        try {
            $count = count($this->selectedUsers);

            // Validate that we only force delete trashed users
            $trashedCount = \App\Models\User::onlyTrashed()->whereIn('id', $this->selectedUsers)->count();
            if ($trashedCount !== $count) {
                throw new \Exception('Some selected users are not in trash.');
            }

            \App\Models\User::withTrashed()->whereIn('id', $this->selectedUsers)->forceDelete();

            $this->selectedUsers = [];
            $this->selectAll = false;

            DB::commit();
            $this->dispatch('toast-success', [
                'title' => __('success'),
                'message' => $count.' '.__('users_deleted_permanently') ?? 'Users deleted permanently!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk force delete failed', ['error' => $e->getMessage()]);
            $this->dispatch('toast-error', [
                'title' => __('error'),
                'message' => 'Bulk force delete failed. Please try again.',
            ]);
        }
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->role = '';
        $this->status = 'Active';
        $this->password = '';
        $this->avatar = null;
        $this->existingAvatar = null;
        $this->userId = null;
    }

    public function hideModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->getUsersQuery()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }
}
