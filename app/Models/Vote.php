<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_id', 'position_id', 'voter_id', 'candidate_id', 'yes', 'no', 'void'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function voter()
    {
        return $this->belongsTo(VoterRegistration::class, 'voter_id', 'id');
    }

    
}
