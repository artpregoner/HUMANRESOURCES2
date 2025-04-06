<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\TicketResponseFile;
use App\Models\TicketCategory;

class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $category_id = '';
    public $response = '';
    public $files = [];
    public $assigned_to = null;
    public $categories;

    protected $rules = [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:ticket_categories,id',
        'response' => 'required|string',
        'files.*' => 'nullable|file|max:2048',
        'assigned_to' => 'nullable|exists:users,id',
    ];

    public function mount()
    {
        $this->categories = TicketCategory::all();
    }

    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files); // Re-index array
    }

    public function store()
    {
        $this->validate();

        // Create ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'assigned_to' => $this->assigned_to,
            'ticket_category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->response,
            'priority' => 'low',
            'status' => 'open',
        ]);

        // Create initial response
        $ticketResponse = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'response_text' => $this->response,
            'responded_at' => now(),
        ]);

        // Handle file uploads
        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $filePath = $file->store('responses', 'public');

                TicketResponseFile::create([
                    'ticket_response_id' => $ticketResponse->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // Clear input fields
        $this->reset(['title', 'category_id', 'response', 'files']);

        // Redirect with success message
        return redirect()->route('portal.helpdesk.show', $ticket->id)
            ->with('success', 'Ticket created successfully.');
    }

    public function render()
    {
        return view('livewire.helpdesk.create');
    }
}
