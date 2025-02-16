<?php

namespace App\Livewire\Hr2\Helpdesk;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\TicketResponseFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Respond extends Component
{
    use WithFileUploads;

    public $ticket;
    public $response = '';
    public $files = [];
    public $showReplyBox = false;
    public $showStatusDropdown = false;
    public $selectedImage = null;
    public $responses;

    protected $listeners = [
        'refreshResponses' => '$refresh',
    ];
    protected $rules = [
        'response' => 'required|string|max:5000',
        'files' => 'nullable|array', // Ensure it's an array
        'files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,xlsx|max:2048', // 2MB max
    ];

    protected $messages = [
        'response.*.required' => 'The response field is required.',
        'files.max' => 'You can upload a maximum of 10 files.',
        'files.*.file' => 'Each upload must be a valid file.',
        'files.*.mimes' => 'Only JPG, JPEG, PNG, WEBP, PDF, DOC, DOCX, and XLSX files are allowed.',
        'files.*.max' => 'Each file must not exceed 5MB.',
    ];


    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->responses = $ticket->responses()->with(['user', 'files'])->get();
    }

    public function toggleReplyBox()
    {
        $this->showReplyBox = !$this->showReplyBox;
    }

    public function toggleStatusDropdown()
    {
        $this->showStatusDropdown = !$this->showStatusDropdown;
    }

    public function updateStatus($status)
    {
        if (!in_array($status, ['open', 'in_progress', 'resolved', 'closed'])) {
            return;
        }

        $this->ticket->status = $status;
        $this->ticket->save();

        $this->showStatusDropdown = false;

        // Corrected dispatch for Livewire v3
        $this->dispatch('alert', type: 'success', message: 'Ticket status updated successfully.');
    }


    public function removeFile($index)
    {
        if (isset($this->files[$index])) {
            unset($this->files[$index]);
            $this->files = array_values($this->files);
        }
    }

    public function discardReply()
    {
        $this->reset(['response', 'files', 'showReplyBox']);
    }

    public function sendReply()
    {
        // Custom validation: Require response only if no files are uploaded
        $this->validate([
            'response' => empty($this->files) ? 'required|string|max:5000' : 'nullable|string|max:5000',
            'files' => 'nullable|array|max:10',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,xlsx|max:2048',
        ], [
            'response.required' => 'The response field is required when no file is uploaded.',
            'files.max' => 'You can upload a maximum of 10 files.',
            'files.*.file' => 'Each upload must be a valid file.',
            'files.*.mimes' => 'Only JPG, JPEG, PNG, WEBP, PDF, DOC, DOCX, and XLSX files are allowed.',
            'files.*.max' => 'Each file must not exceed 2MB.',
        ]);
        // Create the response
        $ticketResponse = TicketResponse::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => Auth::id(),
            'response_text' => $this->response ?? '',
            'responded_at' => now(),
        ]);

        // Secure File Upload Handling
        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                // Generate a safe file name
                $safeFilename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('responses', $safeFilename, 'public');
                $size = $file->getSize(); // Get the file size in bytes

                TicketResponseFile::create([
                    'ticket_response_id' => $ticketResponse->id,
                    'file_path' => $path,
                    'file_name' => $safeFilename,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $size, // Save the file size here
                ]);
            }
        }

        // Reset form and refresh responses
        $this->reset(['response', 'files', 'showReplyBox']);
        $this->responses = $this->ticket->fresh()->responses()->with(['user', 'files'])->get();

        $this->dispatch('alert', type: 'success', message: 'Response sent successfully.');
    }




    public function showImage($path)
    {
        $this->selectedImage = $path;
    }
    public function modalThisImage($path)
    {
        $this->selectedImage = $path;
    }
    public function closeImageModal()
    {
        $this->selectedImage = null;
    }

    public function render()
    {
        return view('livewire.hr2.helpdesk.respond');
    }
}
