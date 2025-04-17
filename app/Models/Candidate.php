<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_id', 'position_id', 'matric_no', 'surname', 'firstname', 'othernames', 'alias', 
                           'college_id', 'department_id', 'level', 'slogan', 'photo', 'banner', 'manifesto', 'bio'];

    
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'id');
    }
}
