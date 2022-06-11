<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'addresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'address_1',
        'address_2',
        'city',
        'state',
        'postcode',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function homeAddressStudentDetails()
    {
        return $this->hasMany(StudentDetail::class, 'home_address_id', 'id');
    }

    public function mailAddressStudentDetails()
    {
        return $this->hasMany(StudentDetail::class, 'mail_address_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
