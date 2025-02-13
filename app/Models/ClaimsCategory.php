<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimsCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'claims_categories';

    protected $fillable = [
        'category_name',
        'description',
        'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean', // Add casting for boolean
    ];
}
