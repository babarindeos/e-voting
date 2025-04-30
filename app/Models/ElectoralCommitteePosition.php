<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralCommitteePosition extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'position'];

    public function members()
    {
        return $this->hasMany(ElectoralCommitteeMember::class, 'position_id', 'id');

        
    }
}
