<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Ticket, TicketCategory, TicketResponse, Notification};
use Illuminate\Support\Facades\{Auth, Storage};

class HelpdeskController extends Controller
{
    public function index()
    {
        $ticketCount = Ticket::where('user_id', Auth::id())->count();

        $tickets = Ticket::with(['category', 'responses' => function($query) {
            $query->latest()->limit(1); // Get only the latest response for each ticket
        }])
        ->where('user_id', Auth::id())->get();

        return view('portal.helpdesk.index', compact('tickets', 'ticketCount'));
    }



    public function create()
    {
        $categories = TicketCategory::all();
        return view('portal.helpdesk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:ticket_categories,id',
            'response' => 'required|string',
            'files.*' => 'nullable|file|max:2048',
        ]);

        // Create ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'ticket_category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->response,
            'priority' => 'low',
            'status' => 'open',
        ]);

        // Create initial response
        $ticketResponse = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'response_text' => $request->response,
            'responded_at' => now(),
        ]);

        // Upload files if available
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $filePath = $file->store('responses', 'public');

                // Save file to TicketResponseFile
                \App\Models\TicketResponseFile::create([
                    'ticket_response_id' => $ticketResponse->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('portal.helpdesk.index')->with('success', 'Ticket created successfully.');
    }


    public function show(Ticket $ticket)
    {
        // Ensure the user has permission to view the ticket
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Fetch the ticket with its responses and any associated files
        $ticket = Ticket::with(['responses.files'])->findOrFail($ticket->id);

        // Pass the ticket and responses to the view
        return view('portal.helpdesk.show', [
            'ticket' => $ticket,
            'responses' => $ticket->responses  // Ensure responses are passed
        ]);
    }

    public function respond(Request $request, Ticket $ticket)
    {
        $request->validate([
            'response' => 'required|string|max:5000',
            'files.*' => 'nullable|file|max:2048',
        ]);

        // Create a new response
        $ticketResponse = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'response_text' => $request->response,
            'responded_at' => now(),
        ]);

        // Handle file uploads if any
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('responses', 'public');

                \App\Models\TicketResponseFile::create([
                    'ticket_response_id' => $ticketResponse->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(), // Save file size in bytes
                ]);
            }
        }


        // Fetch the newly created response, including file details
        $response = $ticketResponse->load('files');

        // Prepare response data
        $responseData = [
            'user_name' => $ticketResponse->user->name,
            'response_text' => $ticketResponse->response_text,
            'files' => $response->files->map(function($file) {
                return [
                    'url' => asset('storage/' . $file->file_path),
                    'name' => $file->file_name,
                ];
            }),
            'created_at' => $ticketResponse->created_at->format('d/m/Y H:i'),
        ];

        // Return the response data as JSON (AJAX)
        return response()->json($responseData);
    }



    public function destroy(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Soft delete the ticket (responses & files remain)
        $ticket->update(['deleted_by' => Auth::id()]);
        $ticket->delete();

        return redirect()->route('portal.helpdesk.index')->with('success', 'Ticket archived successfully.');
    }

    public function forceDelete($id)
    {
        // Find the ticket in the trashed records
        $ticket = Ticket::onlyTrashed()->findOrFail($id);

        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

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

        return redirect()->route('portal.helpdesk.trash')->with('success', 'Ticket permanently deleted.');
    }


    //archive dashboard
    public function trash()
    {
        $tickets = Ticket::onlyTrashed()->with(['category', 'deletedByUser'])->get();
        return view('portal.helpdesk.trash', compact('tickets'));
    }

    //restore deleted ticket
    public function restore($id)
    {
        $ticket = Ticket::onlyTrashed()->findOrFail($id);
        $ticket->restore();
        return redirect()->route('portal.helpdesk.trash')->with('success', 'Ticket restored successfully.');
    }

}
