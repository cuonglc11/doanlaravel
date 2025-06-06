<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'duration',
        'course_id',
        'total_question',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
