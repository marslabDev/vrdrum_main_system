<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentLessonProgress extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'student_lesson_progresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'progress',
        'lesson_category_id',
        'student_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lesson_category()
    {
        return $this->belongsTo(LessonCategory::class, 'lesson_category_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
