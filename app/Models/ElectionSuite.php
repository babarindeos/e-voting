<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionSuite extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name', 'description'];


    public function elections()
    {
        return $this->hasMany(Election::class, 'election_suite_id', 'id');
    }

    public function registered_voters()
    {
        return $this->hasMany(VoterRegistration::class, 'election_suite_id', 'id');
    }
}
