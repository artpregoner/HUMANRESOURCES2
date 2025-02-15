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


class ClaimsController extends Controller
{
    // Display a listing of users.
    public function index()
    {
        $claims = Claim::where('user_id', Auth::id())->with('items.category')->get();
        $claimsCount = Claim::where('user_id', Auth::id())->count();
        $archivedClaimsCount = Claim::onlyTrashed()->where('user_id', Auth::id())->count();


        return view('portal.claims.index', compact('claims', 'claimsCount', 'archivedClaimsCount'));
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

    // Display a specific user.
    public function show($id)
    {
        $claim = Claim::with(['user', 'attachments', 'items.category'])
            ->where(function($query) {
                $query->where('user_id', Auth::id());

            })
            ->findOrFail($id);

        return view('portal.claims.show', compact('claim'));
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
    public function trash()
    {
        $claimsCount = Claim::where('user_id', Auth::id())->count();

        $claims = Claim::onlyTrashed()->get();
        return view('portal.claims.trash', compact('claims', 'claimsCount'));
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
}
