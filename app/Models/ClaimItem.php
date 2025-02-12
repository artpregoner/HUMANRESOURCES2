<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'claim_id',
        'category_id',
        'details',
        'amount',
        'currency',
        'deleted_by'
    ];


    protected $casts = [
        'amount' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function category()
    {
        return $this->belongsTo(ClaimsCategory::class, 'category_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
