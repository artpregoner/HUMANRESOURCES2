<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\ClaimsAttachment;
use App\Models\ClaimsCategory;
use App\Models\ClaimApprover;
use Illuminate\Support\Facades\{Auth, Storage};


class ClaimsController extends Controller
{
    // Display a listing of users.
    public function index()
    {
        $claims = Claim::where('user_id', Auth::id())->with('items.category')->get();
        $ticketCount = Claim::where('user_id', Auth::id())->count();

        return view('portal.claims.index', compact('claims', 'ticketCount'));
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

    // Remove a user from the database.
    public function destroy($id)
    {
        // Code to delete a user
    }
}
