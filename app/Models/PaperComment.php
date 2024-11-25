<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperComment extends Model
{
    use HasFactory;

    protected $fillable = ['paper_id', 'user_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }
}
