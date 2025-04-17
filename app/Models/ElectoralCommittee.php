<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralCommittee extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name'];


    public function members()
    {
        return $this->hasMany(ElectoralCommitteeMember::class, 'electoral_committee_id', 'id');
    }
}
