<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'election_suite_id', 'start_date', 'start_time', 'end_date', 'end_time', 'live_status'];

    public function election_suite()
    {
        return $this->belongsTo(ElectionSuite::class, 'election_suite_id', 'id');
    }
}
