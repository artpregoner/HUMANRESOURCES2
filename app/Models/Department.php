<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Relationship with employees
    public function employees()
    {
        return $this->hasMany(EmployeeDetails::class);
    }

}
