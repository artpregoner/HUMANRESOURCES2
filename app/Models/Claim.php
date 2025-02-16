<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'submitted_by_id',
        'assigned_to_id',
        'approved_by_id',
        'expense_date',
        'submitted_date',
        'approved_date',
        'description',
        'comments',
        'status',
        'reimbursement_required',
        'total_amount',
        'currency',
        'deleted_by'
    ];

    protected $casts = [
        'expense_date' => 'datetime',
        'submitted_date' => 'datetime',
        'approved_date' => 'datetime',
        'reimbursement_required' => 'boolean',
        'total_amount' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];

    // The employee who submitted the claim
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Who submitted the claim (HR/Admin if on behalf of someone else)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // Who is assigned to review the claim
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    // Who approved the claim
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    // Who deleted the claim (if SoftDeletes is used)
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    // Claim items (expenses inside the claim)
    public function items()
    {
        return $this->hasMany(ClaimItem::class);
    }

    // Attachments related to the claim
    public function attachments()
    {
        return $this->hasMany(ClaimsAttachment::class);
    }

    public function approver()
    {
        return $this->hasOne(ClaimApprover::class)->where('action', 'approved')->latest();
    }
    public function unapprover()
    {
        return $this->hasOne(ClaimApprover::class)->where('action', 'unapproved')->latest();
    }

    public function rejector()
    {
        return $this->hasOne(ClaimApprover::class)->where('action', 'rejected')->latest();
    }
    public function unrejector()
    {
        return $this->hasOne(ClaimApprover::class)->where('action', 'unrejected')->latest();
    }


}
