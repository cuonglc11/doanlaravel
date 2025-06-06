<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'content',
        'option',
        'correct',
        'exam_id',
    ];
    public function course()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
}
