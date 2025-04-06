<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\ClaimsAttachment;
use App\Models\ClaimsCategory;
use App\Models\ClaimApprover;
use Illuminate\Support\Facades\{Auth, Storage};
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ClaimsController extends Controller
{
    // Display a listing of users.
    public function index(Request $request)
    {
        // $perPage = $request->input('per_page', 10);
        // $search = $request->input('search');

        $totalClaimsCount = Claim::where('user_id', Auth::id())->count();
        $archivedClaimsCount = Claim::onlyTrashed()->where('user_id', Auth::id())->count();

        // $query = Claim::with([
        //     'items.category'
        // ])->where('user_id', Auth::id());

        // // Apply search filter
        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('status', 'like', "%$search%")
        //           ->orWhere('total_amount', 'like', "%$search%")
        //           ->orWhereHas('user', function ($q) use ($search) {
        //               $q->where('name', 'like', "%$search%");
        //           });
        //     });
        // }


        // // Paginate results
        // $claims = $query->paginate($perPage);

        // return view('portal.claims.index', compact(
        //     'claims',
        //     'totalClaimsCount',
        //     'archivedClaimsCount',
        //     'perPage',
        //     'search'
        // ));
        return view('portal.claims.index', compact('archivedClaimsCount', 'totalClaimsCount'));
    }


    // Show the form for creating a new user.
    public function create()
    {
        return view('portal.claims.create');
    }

    // Store a newly created user in the database.
    public function store(Request $request)
    {
        // Code to save the new user
    }
    private function getStatusBadgeClass(?string $status): string
    {
        // Handle null status by providing a default
        $status = $status ?? 'submitted';

        return match ($status) {
            'approved' => 'badge-success',
            'pending' => 'badge-info',
            'submitted' => 'badge-light',
            'rejected' => 'badge-danger',
            'unapproved' => 'badge-warning',
            default => 'badge-secondary'
        };
    }
    // Display a specific user.
    public function show($id)
    {
        // Load claim with approver, rejector, and other relations
        $claim = Claim::with([
            'approver.user',  // For approved claims
            'rejector.user',  // For rejected claims
            'user',
            'attachments',
            'items.category'
        ])
        ->when(Auth::user()->role === 'employee', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->findOrFail($id);

        // Get the status badge
        $statusBadge = $this->getStatusBadgeClass($claim->status);

        // Determine the name of the approver or rejector
        $approverName = optional($claim->approver?->user)->name;
        $unapproverName = optional($claim->unapprover?->user)->name;
        $rejectorName = optional($claim->rejector?->user)->name;
        $unrejectorName = optional($claim->unrejector?->user)->name;

        // Decide which name to display based on the status
        if ($claim->status === 'approved') {
            $actionedBy = "by: " . ($approverName ?? 'N/A');
        } elseif ($claim->status === 'rejected') {
            $actionedBy = "by: " . ($rejectorName ?? 'N/A');
        } elseif ($claim->status === 'unapproved') {
            $actionedBy = "by: " . ($unapproverName ?? 'N/A');
        } else {
            $actionedBy = "Submitted";
        }

        return view('portal.claims.show', compact('claim', 'statusBadge', 'actionedBy'));
    }




    /**
     * Download the invoice as a PDF.
     */
    public function download($id)
    {
        // $claim = Claim::with('user')->findOrFail($id);
        // $pdf = Pdf::loadView('portal.claims.invoice-pdf', compact('claim'));

        // return $pdf->download("Invoice_Claim_{$claim->id}.pdf");
    }

    // Show the form for editing a user.
    public function edit($id)
    {
        // Code to show the edit form
    }

    // Update a specific user in the database.
    public function update(Request $request, $id)
    {
        // Code to update a user
    }

    // Trash UI
    public function trash(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $claimsCount = Claim::where('user_id', Auth::id())->count();

        $query = Claim::onlyTrashed()->where('user_id', Auth::id());

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('status', 'like', "%$search%")
                    ->orWhere('total_amount', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }

        $claims = $query->paginate($perPage);

        // Fetch deleted users
        foreach ($claims as $claim) {
            if ($claim->deleted_by) {
                $deletedUser = \App\Models\User::find($claim->deleted_by);
                if ($deletedUser) {
                    $claim->deleted_by_name = $deletedUser->id === Auth::id() ? 'You' : $deletedUser->name;
                    $claim->deleted_by_role = match ($deletedUser->role) {
                        'hr' => '(HR)',
                        'admin' => '(Admin)',
                        default => '(Employee)',
                    };
                } else {
                    $claim->deleted_by_name = 'Unknown User';
                    $claim->deleted_by_role = '';
                }
            }
        }

        return view('portal.claims.trash', compact(
        'claims',
        'claimsCount',
        'search',
        'perPage'
        ));
    }


    // Remove a user from the database.
    public function destroy($id)
    {
        $claim = Claim::with(['user', 'attachments', 'items.category'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $claim->update(['deleted_by' => Auth::id()]);
        $claim->delete();

        return redirect()->route('portal.claims.index')->with('success', 'Claim archived successfully.');
    }



    public function restore($id)
    {

        $claim = Claim::onlyTrashed()->findOrFail($id);
        $claim->restore();

        $claim->items()->onlyTrashed()->restore();

        // Restore associated attachments
        $claim->attachments()->onlyTrashed()->restore();

        return redirect()->route('portal.claims.trash')->with('success', 'Claim restored successfully.');

    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();

            $claim = Claim::onlyTrashed()->findOrFail($id);
            $folderPath = 'claims/receipt' . $claim->id; // Define the folder path

            // Delete physical files first
            foreach ($claim->attachments as $attachment) {
                if (Storage::disk('public')->exists($attachment->file_path)) {
                    Storage::disk('public')->delete($attachment->file_path);
                }
                $attachment->forceDelete();
            }

            // Delete the folder if it's empty
            if (Storage::disk('public')->exists($folderPath) && count(Storage::disk('public')->files($folderPath)) === 0) {
                Storage::disk('public')->deleteDirectory($folderPath);
            }

            // Delete associated records
            $claim->items()->forceDelete();
            $claim->forceDelete();

            DB::commit();
            return redirect()->back()->with('success', 'Claim permanently deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Claim force delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting claim permanently.');
        }
    }

    // Add this method to your ClaimsController.php
    public function getDetails(Claim $claim)
    {
        return view('portal.claims.claim_details', compact('claim'));
    }

    public function downloadPDF($id)
    {
        // Load claim with all relationships
        $claim = Claim::with([
            'approver.user',
            'rejector.user',
            'user',
            'attachments',
            'items.category'
        ])
        ->when(Auth::user()->role === 'employee', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->findOrFail($id);

        // Get names
        $approverName = optional($claim->approver?->user)->name;
        $unapproverName = optional($claim->unapprover?->user)->name;
        $rejectorName = optional($claim->rejector?->user)->name;
        $unrejectorName = optional($claim->unrejector?->user)->name;

        // Determine action text
        $actionedBy = match ($claim->status) {
            'approved' => "by: " . ($approverName ?? 'N/A'),
            'rejected' => "by: " . ($rejectorName ?? 'N/A'),
            'unapproved' => "by: " . ($unapproverName ?? 'N/A'),
            default => "Unrejected"
        };

        $data = [
            'claim' => $claim,
            'status' => $claim->status,
            'actionedBy' => $actionedBy,
            'statusBadge' => $this->getStatusBadgeClass($claim->status),
            'isOwner' => Auth::id() === $claim->user_id
        ];

        $pdf = PDF::loadView('pdf.claims.claim-details', $data);
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "claim-details-{$claim->id}.pdf"
        );
    }
}
