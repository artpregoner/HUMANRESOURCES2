<?php

namespace App\Http\Controllers\HR2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HR2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get total user count
        $totalUsers = User::count();

        // Get total claims count
        $totalClaims = Claim::count();

        // Get new submitted claims count (claims with 'submitted' status)
        $newSubmittedClaims = Claim::where('status', 'submitted')->count();

        // Get paid claims count
        $paidClaim = Claim::where('status', 'approved')->count();

        // Get claims status chart data
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

        $chartData = [
            'labels' => array_keys($allStatuses),
            'data' => array_values($allStatuses),
            'colors' => [
                '#f0f0f8',  // Submitted
                '#17a2b8',  // Pending
                '#2ec551',  // Approved
                '#dc3545',  // Rejected
                '#ffc108',  // Unapproved
            ]
        ];

        return view('admin.index', compact(
            'totalClaims',
            'newSubmittedClaims',
            'paidClaim',
            'totalUsers',
            'chartData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
