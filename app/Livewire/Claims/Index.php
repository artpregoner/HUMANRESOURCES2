<?php

namespace App\Livewire\Claims;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use App\Models\Claim;
use App\Models\ClaimsCategory;

class Index extends Component
{
    use WithPagination;

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
        $totalClaimsCount = Claim::count();
        $archivedClaimsCount = Claim::onlyTrashed()->count();


        $query = Claim::with(['user', 'items'])
            // ->where('user_id', '!=', Auth::id()) // Exclude admin's own claims
            ->orderByRaw("
                CASE
                    WHEN status = 'submitted' THEN 1
                    WHEN status = 'pending' THEN 2
                    WHEN status = 'approved' THEN 3
                    WHEN status = 'unapproved' THEN 4
                    WHEN status = 'rejected' THEN 5
                ELSE 6 END, created_at DESC"
            );

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('description', 'like', "%{$this->search}%")
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
        $claims = $query->paginate($this->perPage);

        $categories = ClaimsCategory::withCount('claims')->get();
        // Add canDelete attribute to each claim
        $user = Auth::user();
        $isHr = $user->role === 'hr';

        $claims->getCollection()->transform(function ($claim) use ($user, $isHr) {
            $isOwner = $claim->user_id === $user->id;
            $claim->canDelete = !$isHr || ($isHr && $isOwner);
            return $claim;
        });
        return view('livewire.claims.index', compact(
            'claims',
            'totalClaimsCount',
            'archivedClaimsCount',
            'categories'
        ));
    }
}
