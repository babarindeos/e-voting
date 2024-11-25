<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'time', 'venue', 'message', 'link', 'file', 'filesize', 'filetype', 'user_id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(MeetingComment::class, 'meeting_id', 'id');
    }

    public function papers()
    {
        return $this->hasMany(Agenda::class, 'meeting_id', 'id');
    }
}
