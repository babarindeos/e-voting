<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coverage'];

    public function elections()
    {
        return $this->hasMany(Election::class, 'election_type_id', 'id');
    }
}
