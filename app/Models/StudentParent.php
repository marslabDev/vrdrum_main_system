<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentParent extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const RELATIONSHIP_SELECT = [
        'Mother'      => 'Mother',
        'Father'      => 'Father',
        'Grandma'     => 'Grandma',
        'Grandfather' => 'Grandfather',
        'Brother'     => 'Brother',
        'Sister'      => 'Sister',
        'Guardian'    => 'Guardian',
    ];

    public $table = 'student_parents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'nationality',
        'relationship',
        'address',
        'created_at',
        'updated_at',
        'nric_no',
        'deleted_at',
        'created_by_id',
        'user_id',
    ];

    public function guardianStudentDetails()
    {
        return $this->belongsToMany(StudentDetail::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
