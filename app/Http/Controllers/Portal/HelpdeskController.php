<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    public function index()
    {
        return view ('portal.helpdesk.index');
    }

    public function create()
    {
        return view('portal.helpdesk.create');
    }

    public function store(Request $request)
    {
        // Store new claim
    }

    public function show($id)
    {
        // Show details of a specific claim
    }

    public function edit()
    {
        return view('portal.helpdesk.edit');
    }

    public function update(Request $request, $id)
    {
        // Update an existing claim
    }

    public function destroy($id)
    {
        // Delete a claim
    }

    public function responseHelpdesk(){
        return view('portal.helpdesk.response');
    }
}
