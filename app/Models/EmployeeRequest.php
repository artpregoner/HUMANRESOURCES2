<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeRequest extends Model
{
    use HasFactory;
    protected $table = 'employee_requests'; // Update to match your actual table name

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'birthdate',
        'gender',
        'civil_status',
        'address',
        'social_media',
        'department',

        // Emergency Contact
        'emergency_name',
        'emergency_address',
        'emergency_phone',
        'emergency_relationship',

        'status',
        'approved_by',
    ];
    // Define the relationship to User (assumption that each request is associated with a user)
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');  // Linking by email, assuming the 'email' column in both tables
    }

    /**
     * Relationship: Approved by an Admin (User)
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope to filter pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
