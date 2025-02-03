<?php

// App\Livewire\Helpdesk\Show.php
namespace App\Livewire\Helpdesk;

use App\Models\TicketResponse;
use Livewire\Component;
use Livewire\Attributes\On; // Add this import

class Show extends Component
{
    public $ticketId;
    public $responses;

    #[On('response-created')]
    public function refreshResponses()
    {
        $this->responses = TicketResponse::where('ticket_id', $this->ticketId)
            ->with('user')
            ->latest()
            ->get();
    }

    public function mount($ticketId)
    {
        $this->ticketId = $ticketId;
        $this->refreshResponses(); // Load initial responses
    }

    public function render()
    {
        return view('livewire.helpdesk.show', [
            'responses' => $this->responses
        ]);
    }
}
