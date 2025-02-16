<?php

namespace App\Http\Controllers\HR2;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Storage};

class ClaimsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $claimsCount = Claim::where('user_id', '!=', Auth::id())->count();
        $archivedClaimsCount = Claim::onlyTrashed()->where('user_id', '!=', Auth::id())->count();

        $claims = Claim::with(['user', 'items'])
            // ->where('user_id', '!=', Auth::id()) // Exclude admin's own claims
            ->orderByRaw("
                CASE
                    WHEN status = 'submitted' THEN 1
                    WHEN status = 'pending' THEN 2
                    WHEN status = 'approved' THEN 3
                    WHEN status = 'unapproved' THEN 4
                    WHEN status = 'rejected' THEN 5
                ELSE 6 END, created_at DESC") // Sort newest claims within each status
            ->get();

        return view('hr2.claims.index', compact('claims', 'claimsCount', 'archivedClaimsCount'));
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
    public function show($id)
    {
        $claim = Claim::with(['user', 'attachments', 'items.category'])->findOrFail($id);

        return view('hr2.claims.show', compact('claim'));
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

    public function trash()
    {
        $claimsCount = Claim::count();

        $claims = Claim::onlyTrashed()->get();
        return view('hr2.claims.trash', compact('claims', 'claimsCount'));
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
}
