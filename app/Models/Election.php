<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_suite_id', 'election_type_id', 'name', 'college_id', 
                           'start_date', 'start_time', 'end_date', 'end_time', 'live_status'];


    public function election_suite()
    {
        return $this->belongsTo(ElectionSuite::class, 'election_suite_id', 'id');
    }

    public function election_type()
    {
        return $this->belongsTo(ElectionType::class, 'election_type_id', 'id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'election_id', 'id');
    }

    
    public function positions()
    {
        return $this->hasManyThrough(Position::class, Candidate::class, 'election_id', 'id', 'id', 'position_id');
    }


    public function votes()
    {
        return $this->hasMany(Vote::class, 'election_id', 'id');
    }

    public function finalized_votes()
    {
        return $this->hasMany(FinalizedVote::class, 'election_id', 'id');
    }
}
