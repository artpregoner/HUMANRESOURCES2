<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\{Auth, Storage};
use Illuminate\Support\Facades\DB;

class ClaimsController extends Controller
{
    public function index()
    {
        $claimsCount = Claim::count();
        $archivedClaimsCount = Claim::onlyTrashed()->count();

        $claims = Claim::with(['user'])->get(); // Get all tickets

        return view('admin.claims.index', compact('claims', 'claimsCount', 'archivedClaimsCount'));
    }
    public function show($id)
    {
        $claim = Claim::with(['user', 'attachments', 'items.category'])->findOrFail($id);

        return view('admin.claims.show', compact('claim'));
    }
    public function trash()
    {
        $claimsCount = Claim::count();

        $claims = Claim::onlyTrashed()->get();
        return view('admin.claims.trash', compact('claims', 'claimsCount'));
    }


    // Remove a user from the database.
    public function destroy($id)
    {
        $claim = Claim::with(['attachments', 'items'])->findOrFail($id);

        $claim->update(['deleted_by' => Auth::id()]);

        // Soft delete related records
        $claim->attachments()->delete();
        $claim->items()->delete();

        $claim->delete();

        return redirect()->route('admin.claims.index')->with('success', 'Claim archived successfully.');
    }

    public function restore($id)
    {
        $claim = Claim::onlyTrashed()->findOrFail($id);
        $claim->restore();

        // Restore associated records
        $claim->items()->onlyTrashed()->restore();
        $claim->attachments()->onlyTrashed()->restore();
        $claim->items()->each(function ($item) {
            $item->category()->onlyTrashed()->restore(); // ✅ Restore category if trashed
        });

        return redirect()->route('admin.claims.trash')->with('success', 'Claim restored successfully.');
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

            // Delete folder only if completely empty
            if (Storage::disk('public')->exists($folderPath) && empty(Storage::disk('public')->allFiles($folderPath))) {
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
