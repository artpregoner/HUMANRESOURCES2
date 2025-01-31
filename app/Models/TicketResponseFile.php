<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResponseFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_response_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function response()
    {
        return $this->belongsTo(TicketResponse::class);
    }
}
