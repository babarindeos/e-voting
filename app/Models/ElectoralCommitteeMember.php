<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralCommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'electoral_committee_id', 'position_id', 'surname', 'firstname', 
                           'othernames', 
                           'college_id',
                           'department_id',
                           'level',
                           'photo',
                           'filesize',
                           'filetype',
                           'slogan',
                           'bio'];
    

    public function position()
    {
        return $this->belongsTo(ElectoralCommitteePosition::class, 'position_id', 'id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function electoral_committee()
    {
        return $this->belongsTo(ElectoralCommittee::class, 'electoral_committee_id', 'id');
    }
}
