<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class Trash extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public $perPage = 10;
    public $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $isHr = $user->role === 'hr';

        $query = Ticket::onlyTrashed()
            ->with([
                'category',
                'responses' => fn ($q) => $q->latest()->limit(1),
            ]);

        $filteredQuery = clone $query;

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('id', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('status', 'like', "%{$this->search}%")
                  ->orWhereHas('user', fn ($subQ) =>
                      $subQ->where('name', 'like', "%{$this->search}%")
                  );
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $tickets = $query->paginate($this->perPage);

        // Add canDelete attribute
        foreach ($tickets as $ticket) {
            $isOwner = $ticket->user_id === $user->id;
            $ticket->canDelete = !$isHr || ($isHr && $isOwner);
        }

        return view('livewire.helpdesk.trash', [
            'tickets' => $tickets,
            'totalTicketCount' => Ticket::where('user_id', $user->id)->count(),
            'filteredTicketCount' => $filteredQuery->count(),
        ]);
    }
}
