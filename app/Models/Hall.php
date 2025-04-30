<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_suite_id', 'name'];

    public function residents()
    {
        return $this->hasMany(HallResident::class, 'hall_id', 'id');
    }

    public function election_suite()
    {
        return $this->belongsTo(ElectionSuite::class, 'election_suite_id', 'id');
    }
}
