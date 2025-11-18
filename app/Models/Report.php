<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'type',
        'description',
        'date',
        'image',
        'status',
    ];

    // Relationship: a report belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
