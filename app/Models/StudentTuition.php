<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTuition extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'student_tuitions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'minute_left',
        'tuition_package_id',
        'student_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tuition_package()
    {
        return $this->belongsTo(TuitionPackage::class, 'tuition_package_id');
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
