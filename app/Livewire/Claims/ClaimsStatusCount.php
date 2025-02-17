<?php

namespace App\Livewire\Claims;

use Livewire\Component;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;
class ClaimsStatusCount extends Component
{
    public $chartData;

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        // Get counts for each status from the database
        $statusCounts = Claim::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // Ensure all statuses have a value, default to 0 if no claims exist
        $allStatuses = [
            'Submitted' => $statusCounts['submitted'] ?? 0,
            'Pending' => $statusCounts['pending'] ?? 0,
            'Approved' => $statusCounts['approved'] ?? 0,
            'Rejected' => $statusCounts['rejected'] ?? 0,
            'Unapproved' => $statusCounts['unapproved'] ?? 0,
        ];

        $this->chartData = [
            'labels' => array_keys($allStatuses),
            'data' => array_values($allStatuses),
            'colors' => [
                '#f9f9ff',  // Approved (badge-success)
                '#17a2b8',  // Pending (badge-info)
                '#2ec551',  // Submitted (badge-light)
                '#dc3545',  // Unapproved (badge-warning)
                '#ffc108',  // Rejected (badge-danger)ffc108
            ]
        ];
    }
    public function render()
    {
        return view('livewire.claims.claims-status-count');
    }
}
