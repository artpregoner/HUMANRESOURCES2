<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TicketResponseFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_response_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];

    public function response()
    {
        return $this->belongsTo(TicketResponse::class);
    }
    public function files()
    {
        return $this->hasMany(TicketResponseFile::class)->withTrashed();
    }

}
