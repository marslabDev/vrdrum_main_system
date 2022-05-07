<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonLevel extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'lesson_levels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'level',
        'name',
        'lesson_category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lesson_category()
    {
        return $this->belongsTo(LessonCategory::class, 'lesson_category_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
