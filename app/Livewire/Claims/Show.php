<?php

namespace App\Livewire\Claims;

use App\Models\Claim;
use App\Models\User;
use App\Models\ClaimApprover;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Show extends Component
{
    public $claim;
    public $status;
    public $approverName;
    public $approvedDate;
    public $rejectedBy;
    public $unapprovedBy;
    public $isOwner;


    public function mount(Claim $claim)
    {
        $this->claim = $claim;
        $this->isOwner = $this->claim->user_id === Auth::id(); // Check if the logged-in user is the owner

        // Update status from submitted to pending when viewing
        if ($this->claim->status === 'submitted') {
            $this->claim->update(['status' => 'pending']);

            // Log the status change
            ClaimApprover::create([
                'claim_id' => $this->claim->id,
                'user_id' => Auth::id(),
                'action' => 'status_changed',
                'comments' => 'Status automatically changed from submitted to pending on view.',
                'action_at' => now()
            ]);
        }

        $this->status = $this->claim->status;
        $this->approverName = $claim->approved_by_id ? User::find($claim->approved_by_id)->name : 'N/A';
        $this->approvedDate = $claim->approved_date ? Carbon::parse($claim->approved_date)->format('Y-m-d H:i:s') : 'N/A';
        $this->unapprovedBy = ClaimApprover::where('claim_id', $claim->id)->where('action', 'unapproved')->latest()->first()?->user->name ?? 'N/A';
        $this->rejectedBy = ClaimApprover::where('claim_id', $claim->id)->where('action', 'rejected')->latest()->first()?->user->name ?? 'N/A';
    }

    public function approve()
    {
        if ($this->isOwner) {
            return; // Prevent owners from approving their own claims
        }
        if ($this->status === 'approved') {
            // Unapprove (set back to pending)
            $this->claim->update([
                'status' => 'unapproved',
                'approved_by_id' => null,
                'approved_date' => null,
            ]);

            $this->status = 'unapproved';
            $this->approverName = 'N/A';
            $this->approvedDate = 'N/A';

            // Log the unapproval action
            ClaimApprover::updateOrCreate(
                ['claim_id' => $this->claim->id, 'user_id' => Auth::id(), 'action' => 'approved'],
                ['action' => 'unapproved', 'comments' => 'Approval was removed.', 'action_at' => now()]
            );

            // Fetch latest unapproved by user
            $this->unapprovedBy = ClaimApprover::where('claim_id', $this->claim->id)
                ->where('action', 'unapproved')
                ->latest()
                ->first()?->user->name ?? 'N/A';
        } else {
            // Approve the claim
            $this->claim->update([
                'status' => 'approved',
                'approved_by_id' => Auth::id(),
                'approved_date' => now(),
            ]);

            $this->status = 'approved';
            $this->approverName = Auth::user()->name;
            $this->approvedDate = now()->format('Y-m-d H:i:s');

            // Log the approval action
            ClaimApprover::updateOrCreate(
                ['claim_id' => $this->claim->id, 'user_id' => Auth::id()],
                ['action' => 'approved', 'comments' => 'Claim approved.', 'action_at' => now()]
            );

            $this->unapprovedBy = 'N/A';
        }

        $this->dispatch('claimUpdated');
    }


    public function reject()
    {
        if ($this->isOwner) {
            return; // Prevent owners from rejecting their own claims
        }
        if ($this->status === 'rejected') {
            // Undo rejection (set back to pending)
            $this->claim->update([
                'status' => 'pending',
                'approved_by_id' => null,
                'approved_date' => null,
            ]);

            $this->status = 'pending';
            $this->approverName = 'N/A';
            $this->approvedDate = 'N/A';
            $this->rejectedBy = 'N/A';
            $this->unapprovedBy = 'N/A';


            // Update or create the unreject action
            ClaimApprover::updateOrCreate(
                ['claim_id' => $this->claim->id, 'user_id' => Auth::id(), 'action' => 'rejected'],
                ['action' => 'unrejected', 'comments' => 'Rejection was removed.', 'action_at' => now()]
            );
        } else {
            // Reject the claim
            $this->claim->update([
                'status' => 'rejected',
                'approved_by_id' => null,
                'approved_date' => null,
            ]);

            $this->status = 'rejected';
            $this->approverName = 'N/A';
            $this->approvedDate = 'N/A';
            $this->rejectedBy = Auth::user()->name;
            $this->unapprovedBy = Auth::user()->name;

            // Update or create the reject action
            ClaimApprover::updateOrCreate(
                ['claim_id' => $this->claim->id, 'user_id' => Auth::id()],
                ['action' => 'rejected', 'comments' => 'Claim rejected.', 'action_at' => now()]
            );
        }

        $this->dispatch('claimUpdated');
    }


    public function render()
    {
        return view('livewire.claims.show', [
            'claim' => $this->claim,
        ]);
    }
}
