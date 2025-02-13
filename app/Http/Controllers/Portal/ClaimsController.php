<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\{Auth, Storage};


class ClaimsController extends Controller
{
    // Display a listing of users.
    public function index()
    {
        $claims = Claim::where('user_id', Auth::id())->with('items.category')->get();

        return view('portal.claims.index', compact('claims'));
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
        // Code to display a user's details
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
