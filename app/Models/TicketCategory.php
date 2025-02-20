<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean', // Add casting for boolean
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
