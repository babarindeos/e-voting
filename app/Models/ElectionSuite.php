<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionSuite extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name', 'description'];
}
