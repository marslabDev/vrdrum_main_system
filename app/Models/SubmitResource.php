<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmitResource extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'submit_resources';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'answer_text',
        'url',
        'student_work_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student_work()
    {
        return $this->belongsTo(StudentWork::class, 'student_work_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
