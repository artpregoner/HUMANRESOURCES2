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
        // Base query
        $query = Ticket::with(['category', 'responses' => fn ($q) => $q->latest()->limit(1)]);

        // Clone query to get correct counts
        $filteredQuery = clone $query;

        // Apply search filtering
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%")
                    ->orWhere('id', 'like', "%{$this->search}%")
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%"); // Added email search
                    });
            });
        }

        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        return view('livewire.helpdesk.index', [
            'tickets' => $query->paginate($this->perPage),
            'totalTicketCount' => Ticket::count(),
            'filteredTicketCount' => $filteredQuery->count()
        ]);
    }
}
