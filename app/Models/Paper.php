<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    protected $fillable = [ 'paper_no', 'title', 'college_id', 'department_id', 'author', 
                            'other_authors', 'note', 'file', 'filetype', 'filesize', 'user_id',
                            'status'];

    
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paper_author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paper_college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function paper_department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    
}
