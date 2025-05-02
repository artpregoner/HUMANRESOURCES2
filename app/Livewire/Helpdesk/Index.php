<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Livewire\Attributes\Url;

class Index extends Component
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
        // Authenticated user
        $user = Auth::user();
        $isHr = $user->role === 'hr';

        // Base query
        $query = Ticket::with([
            'category',
            'responses' => fn ($q) => $q->latest()->limit(1)
        ]);

        // Clone query to calculate filtered count later
        $filteredQuery = clone $query;

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%")
                    ->orWhere('id', 'like', "%{$this->search}%")
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%");
                    });
            });

            // Apply search filter to cloned query as well
            $filteredQuery->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%")
                    ->orWhere('id', 'like', "%{$this->search}%")
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%");
                    });
            });
        }

        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
            $filteredQuery->where('status', $this->statusFilter);
        }

        // Paginate
        $tickets = $query->paginate($this->perPage);

        // Add canDelete attribute
        foreach ($tickets as $ticket) {
            $isOwner = $ticket->user_id === $user->id;
            $ticket->canDelete = !$isHr || ($isHr && $isOwner);
        }

        return view('livewire.helpdesk.index', [
            'tickets' => $tickets,
            'totalTicketCount' => Ticket::count(),
            'filteredTicketCount' => $filteredQuery->count(),
        ]);
    }
}
