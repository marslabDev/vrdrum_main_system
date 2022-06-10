<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDetail extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
        'Other'  => 'Other',
    ];

    public $table = 'student_details';

    public static $searchable = [
        'full_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'is_handicapped',
        'created_at',
        'gender',
        'country',
        'home_address',
        'mail_address',
        'state',
        'city',
        'postcode',
        'phone',
        'updated_at',
        'deleted_at',
        'nric_no',
        'user_id',
        'created_by_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function guardians()
    {
        return $this->belongsToMany(StudentParent::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
