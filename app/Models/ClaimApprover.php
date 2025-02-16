<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimApprover extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'claim_id',
        'user_id',
        'action', // e.g., approved/rejected
        'comments',
        'action_at',
        'deleted_by'
    ];

    protected $casts = [
        'action_at' => 'datetime',
    ];

    /**
     * Get the claim associated with this approval/rejection.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id');
    }

    /**
     * Get the user (HR/Admin) who approved/rejected the claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user who deleted this record (if applicable).
     */
    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
