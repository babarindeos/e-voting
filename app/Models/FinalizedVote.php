<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalizedVote extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_id', 'voter_id'];
}
