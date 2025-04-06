<?php

namespace App\Http\Controllers\HR2;

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
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $totalTicketCount = Ticket::count();
        $archivedTicketCount = Ticket::onlyTrashed()->count();

        $query = Ticket::with([
            'user',
            'category',
            'responses' => function($query) {
            $query->latest()->limit(1);
        }]);

        // Apply search filter if provided
        if ($search) {
            $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
        }
        $filteredTicketCount = $query->count();
        $tickets = $query->paginate($perPage);

        return view('hr2.helpdesk.index', compact(
            'tickets',
            'totalTicketCount',
            'archivedTicketCount',
            'perPage',
            'search',
            'filteredTicketCount'
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
        return view('hr2.helpdesk.show', [
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

        // Retrieve all related ticket responses and their files
        $ticketResponses = $ticket->responses;

        foreach ($ticketResponses as $ticketResponse) {
            $ticketResponseFiles = $ticketResponse->files; // Assuming a relationship for files

            foreach ($ticketResponseFiles as $file) {
                // Delete the file from the storage
                if (Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                }
            }
        }

        // Delete the ticket after removing attachments
        $ticket->delete();

        return redirect()->route('hr2.helpdesk.index')->with('error', 'Ticket deleted successfully.');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed', // Ensure the status is one of the valid options
        ]);

        // Update ticket status
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('hr2.helpdesk.show', $ticket->id)->with('success', 'Ticket status updated successfully.');
    }

        //archive dashboard
        public function trash()
        {
            $tickets = Ticket::onlyTrashed()->with(['category', 'deletedByUser'])->get();
            $ticketsCount = Ticket::count();

            return view('hr2.helpdesk.trash', compact('tickets', 'ticketsCount'));
        }

        //restore deleted ticket
        public function restore($id)
        {
            $ticket = Ticket::onlyTrashed()->findOrFail($id);
            $ticket->restore();
            return redirect()->route('hr2.helpdesk.trash')->with('success', 'Ticket restored successfully.');
        }

}
