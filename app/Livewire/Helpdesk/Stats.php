<?php

namespace App\Livewire\Helpdesk;

use App\Models\Ticket;
use Livewire\Component;
class Stats extends Component
{
    #[\Livewire\Attributes\Computed]
    public function totalTickets()
    {
        return number_format(Ticket::count(), 0, ',', '.');
    }

    #[\Livewire\Attributes\Computed]
    public function pendingTickets()
    {
        return number_format(Ticket::whereIn('status', ['open', 'in_progress'])->count(), 0, ',', '.');
    }

    #[\Livewire\Attributes\Computed]
    public function resolvedTickets()
    {
        return number_format(Ticket::where('status', 'resolved')->count(), 0, ',', '.');
    }

    #[\Livewire\Attributes\Computed]
    public function deletedTickets()
    {
        return number_format(Ticket::onlyTrashed()->count(), 0, ',', '.');
    }
    public function render()
    {
        return view('livewire.helpdesk.stats');
    }
}
