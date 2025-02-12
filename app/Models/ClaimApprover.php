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
        'action',
        'comments',
        'action_at',
        'deleted_by'
    ];

    protected $casts = [
        'action_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
