<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\TicketResponseFile;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Respond extends Component
{
    use WithFileUploads;

    public $ticket;
    public $response = '';
    public $files = [];
    public $showReplyBox = false;
    public $selectedImage = null;
    public $responses;
    public $showStatusDropdown = false;

    protected $listeners = [
        'refreshResponses' => '$refresh',
    ];

    protected $rules = [
        'response' => 'nullable|string|max:2000',
        'files' => 'nullable|array|max:10',
        'files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,xlsx|max:2048',
    ];

    protected $messages = [
        'response.required' => 'The response field is required when no file is uploaded.',
        'files.max' => 'You can upload a maximum of 10 files.',
        'files.*.file' => 'Each upload must be a valid file.',
        'files.*.mimes' => 'Only JPG, JPEG, PNG, WEBP, PDF, DOC, DOCX, and XLSX files are allowed.',
        'files.*.max' => 'Each file must not exceed 2MB.',
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

    public function downloadFile($fileId)
    {
        $file = TicketResponseFile::findOrFail($fileId);
        $filePath = storage_path('app/public/' . $file->file_path);

        if (!file_exists($filePath)) {
            session()->flash('error', 'File not found.');
            return;
        }

        return response()->download($filePath, $file->file_name);
    }

    public function updateStatus($status)
    {
        if (!in_array($status, ['open', 'in_progress', 'resolved', 'closed'])) {
            return;
        }

        $this->ticket->status = $status;
        $this->ticket->save();
        $this->showStatusDropdown = false;

        $this->dispatch('flashMessage', type: 'success', message: 'Ticket status updated successfully.');
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
        $this->resetErrorBag(); // Clears all validation errors


        // Validate the response or files to ensure at least one is provided
        $this->validate();

        // Prevent submission if neither response nor files are provided
        if (empty($this->response) && empty($this->files)) {
            session()->flash('error', 'Please provide either a message or upload a file.');
            return;
        }

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
                $safeFilename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('responses', $safeFilename, 'public');
                $size = $file->getSize();

                TicketResponseFile::create([
                    'ticket_response_id' => $ticketResponse->id,
                    'file_path' => $path,
                    'file_name' => $safeFilename,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $size,
                ]);
            }
        }

        // Reset form and refresh responses
        $this->reset(['response', 'files', 'showReplyBox']);
        $this->responses = $this->ticket->fresh()->responses()->with(['user', 'files'])->get();

        // Dispatch success message
        $this->dispatch('flashMessage', type: 'success', message: 'Response sent successfully.');
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
        return view('livewire.helpdesk.respond');
    }
}
