<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoachDetail extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const ENROLLMENT_STATUS_SELECT = [
        'part_time' => 'Part time',
        'full_time' => 'Full time',
    ];

    public $table = 'coach_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'enrollment_status',
        'coach_efk',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
