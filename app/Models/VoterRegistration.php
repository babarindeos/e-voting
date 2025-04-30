<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoterRegistration extends Model
{
    
    use HasFactory;

    protected $fillable = ['user_id', 'election_suite_id', 'uuid', 'matric_no', 'surname', 'firstname', 'othernames', 'phone', 'college_id', 'department_id', 'level'];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
