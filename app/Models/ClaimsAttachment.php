<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimsAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'claim_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'deleted_by'
    ];


    protected $casts = [
        'file_size' => 'integer',
        'deleted_at' => 'datetime', // Replaced $dates
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
