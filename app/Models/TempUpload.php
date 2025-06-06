<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUpload extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'hall_id', 'matric_no', 'fullname'];
}
