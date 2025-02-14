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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function items()
    {
        return $this->hasMany(ClaimItem::class);
    }

    public function attachments()
    {
        return $this->hasMany(ClaimsAttachment::class);
    }

    public function approvers()
    {
        return $this->hasMany(ClaimApprover::class);
    }
}
