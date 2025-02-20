<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeDetails extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'designation',
        'joining_date',
        'employee_code',
        'employment_status',
        'work_location',
        'salary',
        'bank_account_number',
        'bank_name',
        'tax_id'
    ];

    // Cast attributes to native types
    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2'
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
