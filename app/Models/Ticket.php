<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'assigned_to', 'ticket_category_id', 'title', 'description', 'priority', 'status', 'deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    // Ticket responses (including soft-deleted ones)
    public function responses()
    {
        return $this->hasMany(TicketResponse::class, 'ticket_id')->withTrashed();
    }


    // Relationship: Creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Assigned User (Admin/HR/User)
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

}
