<?php

namespace App\Livewire\Portal\Claims;

use Livewire\Component;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Trash extends Component
{
    use WithPagination;
    #[Url(as: 'q')]

    public $perPage = 10;
    public $search = '';
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
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    public function render()
    {
        $totalClaimsCount = Claim::where('user_id', Auth::id())->count();
        $archivedClaimsCount = Claim::onlyTrashed()->where('user_id', Auth::id())->count();

        $query = Claim::onlyTrashed()->where('user_id', Auth::id());

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('status', 'like', "%{$this->search}%")
                  ->where('id', 'like', "%{$this->search}%")
                  ->orWhere('total_amount', 'like', "%{$this->search}%")
                  ->orWhereHas('items', function ($q) {
                      $q->where('details', 'like', "%{$this->search}%");
                  })
                  ->orWhereHas('user', function ($q) {
                      $q->where('name', 'like', "%{$this->search}%");
                  });
            });
        }
        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        $claims = $query->paginate($this->perPage);

        return view('livewire.portal.claims.trash', compact(
            'claims',
            'totalClaimsCount',
            'archivedClaimsCount'
        ));
    }
}
