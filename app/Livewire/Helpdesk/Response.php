<?php
// App\Livewire\Helpdesk\Response.php
namespace App\Livewire\Helpdesk;

use Livewire\Component;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; // Add this import

class Response extends Component
{
    public $ticketId;
    public $responseText;

    public function submit()
    {
        $this->validate([
            'responseText' => 'required|string',
        ]);

        TicketResponse::create([
            'ticket_id' => $this->ticketId,
            'response_text' => $this->responseText,
            'responded_at' => now(),
            'user_id' => Auth::id(),
        ]);

        $this->dispatch('response-created')->to('helpdesk.show'); // Specify the target component

        $this->reset(['responseText']);
        session()->flash('message', 'Response submitted successfully.');
    }

    public function render()
    {
        return view('livewire.helpdesk.response');
    }
}
