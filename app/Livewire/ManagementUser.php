<?php

namespace App\Livewire;

use Livewire\Component;

class ManagementUser extends Component
{
    public function render()
    {
        return view('livewire.management-user')->layout('layouts.app');
    }
}
