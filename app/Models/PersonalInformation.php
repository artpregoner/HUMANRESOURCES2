<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'marital_status',
        'blood_group',
        'nationality',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'emergency_contact_name',
        'emergency_contact_number',
        'emergency_relationship'
    ];

    // Cast attributes to native types
    protected $casts = [
        'date_of_birth' => 'date'
    ];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
