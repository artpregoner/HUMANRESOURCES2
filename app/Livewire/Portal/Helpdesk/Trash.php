<?php

namespace App\Livewire\Portal\Helpdesk;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Livewire\Attributes\Url;
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
        // Base query
        $query = Ticket::onlyTrashed()->with(['category', 'responses' => fn ($q) => $q->latest()->limit(1)])
            ->where('user_id', Auth::id());

        // Clone query to get correct counts
        $filteredQuery = clone $query;

        // Apply search filtering
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->where('id', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('status', 'like', "%{$this->search}%")
                  ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
            });
        }

        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.portal.helpdesk.trash', [
            'tickets' => $query->paginate($this->perPage),
            'totalTicketCount' => Ticket::where('user_id', Auth::id())->count(),
            'filteredTicketCount' => $filteredQuery->count()
        ]);
    }
}
