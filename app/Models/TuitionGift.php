<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuitionGift extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        'lesson'  => 'Lesson',
        'product' => 'Product',
    ];

    public $table = 'tuition_gifts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'total_minute',
        'quantity',
        'tuition_package_id',
        'inventory_efk',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tuition_package()
    {
        return $this->belongsTo(TuitionPackage::class, 'tuition_package_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
