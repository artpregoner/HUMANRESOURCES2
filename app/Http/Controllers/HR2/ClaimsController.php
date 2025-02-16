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
        $claimsCount = Claim::count();
        $archivedClaimsCount = Claim::onlyTrashed()->count();

        $claims = Claim::with(['user' => function($query) {
            $query->latest()->limit(1); // Get only the latest response for each ticket
        }])->get(); // Get all tickets

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
        $claimsCount = Claim::where('user_id', Auth::id())->count();

        $claims = Claim::onlyTrashed()->get();
        return view('portal.claims.trash', compact('claims', 'claimsCount'));
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
