<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public array $stats = [];
    public array $activities = [];

    public function mount(): void
    {
        $this->stats = [
            [
                'label' => 'CPU Usage',
                'value' => '24.5',
                'unit' => '%',
                'trend' => '+2.1%',
                'icon' => 'bi bi-cpu',
                'color' => 'bg-indigo-500',
            ],
            [
                'label' => 'Memory',
                'value' => '12.8',
                'unit' => 'GB',
                'trend' => '-0.5%',
                'icon' => 'bi bi-memory',
                'color' => 'bg-purple-500',
            ],
            [
                'label' => 'Latency',
                'value' => '14',
                'unit' => 'MS',
                'trend' => '+1ms',
                'icon' => 'bi bi-reception-4',
                'color' => 'bg-cyan-500',
            ],
            [
                'label' => 'Requests',
                'value' => '1.2M',
                'unit' => 'REQ',
                'trend' => '+15%',
                'icon' => 'bi bi-globe',
                'color' => 'bg-rose-500',
            ],
        ];

        $this->activities = [
            [
                'title' => 'Server Indonesia-01 Restarted',
                'time' => '2 mins ago',
                'color' => 'bg-emerald-500',
            ],
            [
                'title' => 'New SSL Certificate Issued',
                'time' => '45 mins ago',
                'color' => 'bg-blue-500',
            ],
            [
                'title' => 'Unauthorized Login Attempt',
                'time' => '2 hours ago',
                'color' => 'bg-rose-500',
            ],
            [
                'title' => 'Database Backup Completed',
                'time' => '5 hours ago',
                'color' => 'bg-amber-500',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
