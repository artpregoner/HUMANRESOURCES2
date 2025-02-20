<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
        'is_active',
        'last_login'
    ];


        // Add this method to get profile photo URL
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path && Storage::disk('public')->exists($this->profile_photo_path)) {
            return Storage::url($this->profile_photo_path);
        }

        return asset('template/assets/images/avatar-1.jpg');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Role-based access check methods
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isHR()
    {
        return $this->role === 'hr';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }



    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }


    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relationship with employee details
    public function employeeDetails()
    {
        return $this->hasOne(EmployeeDetails::class, 'user_id');
    }

    // Relationship with personal information
    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class, 'user_id');
    }

}
