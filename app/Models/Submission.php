<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'IN_REVIEW'       => 'In Review',
        'PASSED'          => 'Passed',
        'NEED_CORRECTION' => 'Need Correction',
    ];

    public $table = 'submissions';

    public static $searchable = [
        'status',
    ];

    protected $dates = [
        'submit_at',
        'mark_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'submit_at',
        'mark',
        'mark_at',
        'student_work_id',
        'student_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getSubmitAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSubmitAtAttribute($value)
    {
        $this->attributes['submit_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getMarkAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setMarkAtAttribute($value)
    {
        $this->attributes['mark_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function student_work()
    {
        return $this->belongsTo(StudentWork::class, 'student_work_id');
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
