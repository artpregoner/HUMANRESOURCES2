<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Ticket, TicketCategory, TicketResponse, Notification};
use Illuminate\Support\Facades\{Auth, Storage};
class HelpdeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 per page
        $search = $request->input('search'); // Get search query

        $totalTicketCount = Ticket::count(); // Total tickets (ignoring search)
        $archivedTicketCount = Ticket::onlyTrashed()->count();

        // Build query with relationships
        $query = Ticket::with([
            'user',
            'category',
            'responses' => function ($query) {
                $query->latest()->limit(1);
            }
        ]);

        // Apply search filter if provided
        if ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }

        // Get total count AFTER filtering
        $filteredTicketCount = $query->count();

        // Paginate results
        $tickets = $query->paginate($perPage);

        return view('admin.helpdesk.index', compact(
            'tickets',
            'totalTicketCount',
            'filteredTicketCount',
            'archivedTicketCount',
            'perPage',
            'search'
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
    public function show(Ticket $ticket)
    {

        // Fetch the ticket with its responses and any associated files
        $ticket = Ticket::with(['responses.files'])->findOrFail($ticket->id);

        // Pass the ticket and responses to the view
        return view('admin.helpdesk.show', [
            'ticket' => $ticket,
            'responses' => $ticket->responses,  // Ensure responses are passed
            'status' => $ticket->status  // Pass current status

        ]);

    }

    // public function respond(Request $request, Ticket $ticket)
    // {
    //     $request->validate([
    //         'response' => 'required|string|max:5000',
    //         'files.*' => 'nullable|file|max:2048',
    //     ]);

    //     // Create a new response
    //     $ticketResponse = TicketResponse::create([
    //         'ticket_id' => $ticket->id,
    //         'user_id' => Auth::id(),
    //         'response_text' => $request->response,
    //         'responded_at' => now(),
    //     ]);

    //     // Handle file uploads if any
    //     if ($request->hasFile('files')) {
    //         foreach ($request->file('files') as $file) {
    //             $filePath = $file->store('responses', 'public');

    //             // Save file to TicketResponseFile
    //             \App\Models\TicketResponseFile::create([
    //                 'ticket_response_id' => $ticketResponse->id,
    //                 'file_path' => $filePath,
    //                 'file_name' => $file->getClientOriginalName(),
    //                 'file_type' => $file->getClientMimeType(),
    //             ]);
    //         }
    //     }

    // }

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
    public function destroy(Ticket $ticket)
    {
        // Check if the current user has permission to delete
        // Check if the logged-in user is an admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Set the deleted_by field to the current user's ID (admin who is deleting)
        $ticket->deleted_by = Auth::id();  // Ensure this is set
        $ticket->save();  // Save the ticket to update the deleted_by field

        // Soft delete the ticket
        $ticket->delete();

        // Redirect to the helpdesk index with a success message
        return redirect()->route('admin.helpdesk.index')->with('success', 'Ticket archived successfully.');
    }


    public function forceDelete($id)
    {
        // Find the ticket in the trashed records
        $ticket = Ticket::onlyTrashed()->findOrFail($id);

        // Retrieve all related responses
        $ticketResponses = $ticket->responses()->withTrashed()->get();

        foreach ($ticketResponses as $ticketResponse) {
            $ticketResponseFiles = $ticketResponse->files()->withTrashed()->get();

            foreach ($ticketResponseFiles as $file) {
                // Delete the file from storage
                if (Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                }
                // Permanently delete the file record
                $file->forceDelete();
            }

            // Permanently delete the response
            $ticketResponse->forceDelete();
        }

        // Permanently delete the ticket
        $ticket->forceDelete();

        return redirect()->route('admin.helpdesk.trash')->with('success', 'Ticket permanently deleted.');
    }


    //archive dashboard
    public function trash()
    {
        $tickets = Ticket::onlyTrashed()->with(['category', 'deletedByUser'])->get();
        $ticketsCount = Ticket::count();
        $deletedTicket = Ticket::onlyTrashed()->count();
        return view('admin.helpdesk.trash', compact('tickets', 'ticketsCount', 'deletedTicket'));
    }

    //restore deleted ticket
    public function restore($id)
    {
        $ticket = Ticket::onlyTrashed()->findOrFail($id);
        $ticket->restore();
        return redirect()->route('admin.helpdesk.trash')->with('success', 'Ticket restored successfully.');
    }


    // public function updateStatus(Request $request, Ticket $ticket)
    // {
    //     $request->validate([
    //         'status' => 'required|in:open,in_progress,resolved,closed', // Ensure the status is one of the valid options
    //     ]);

    //     // Update ticket status
    //     $ticket->status = $request->status;
    //     $ticket->save();

    //     return redirect()->route('admin.helpdesk.show', $ticket->id)->with('success', 'Ticket status updated successfully.');
    // }


}
