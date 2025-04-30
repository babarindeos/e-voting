<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallResident extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'hall_id', 'matric_no', 'fullname'];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'id');
    }
}
