<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonTimeCoach extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'lesson_time_coaches';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lesson_time_id',
        'coach_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lesson_time()
    {
        return $this->belongsTo(LessonTime::class, 'lesson_time_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
