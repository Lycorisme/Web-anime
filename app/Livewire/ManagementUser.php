<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ManagementUser extends Component
{
    use \Livewire\WithPagination;

    public $name, $email, $phone, $role, $status, $password;
    public $userId;
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';
    public $filterRole = '';
    public $filterStatus = '';
    public $selectedUsers = [];
    public $selectAll = false;

    // Listeners for events triggered from the frontend
    protected $listeners = ['deleteConfirmed' => 'delete', 'bulkDeleteConfirmed' => 'bulkDelete', 'deleteUser'];

    public function render()
    {
        $users = \App\Models\User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterRole, function ($query) {
                $query->where('role', $this->filterRole);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.management-user', [
            'users' => $users
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
        ]);

        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'password' => Hash::make($this->password),
        ]);

        $this->hideModal();
        $this->dispatch('toast-success', detail: [
            'title' => 'Success',
            'message' => 'User created successfully!'
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
        
        $this->isEdit = true;
        $this->isOpen = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required',
            'status' => 'required',
        ]);

        $user = \App\Models\User::findOrFail($this->userId);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
        ];
        
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        $this->hideModal();
        $this->dispatch('toast-success', detail: [
            'title' => 'Success',
            'message' => 'User updated successfully!'
        ]);
        
        $this->resetInputFields();
    }

    public function delete($id)
    {
        \App\Models\User::find($id)->delete();
        $this->selectedUsers = array_diff($this->selectedUsers, [$id]);
        
        $this->dispatch('toast-success', detail: [
            'title' => 'Success',
            'message' => 'User deleted successfully!'
        ]);
    }
    
    // Helper to receive ID from event
    public function deleteUser($id) {
        $this->delete($id);
    }

    public function bulkDelete()
    {
        if (count($this->selectedUsers) > 0) {
            \App\Models\User::whereIn('id', $this->selectedUsers)->delete();
            $this->selectedUsers = [];
            $this->selectAll = false;
            
            $this->dispatch('toast-success', detail: [
                'title' => 'Success',
                'message' => 'Selected users deleted successfully!'
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
            $this->selectedUsers = \App\Models\User::pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }
}
