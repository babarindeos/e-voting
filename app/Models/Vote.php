<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_id', 'position_id', 'voter_id', 'candidate_id', 'yes', 'no', 'void'];
}
