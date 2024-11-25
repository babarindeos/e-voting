<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['meeting_id', 'paper_id', 'title'];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }
}
