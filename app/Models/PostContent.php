<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostContent extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const RESOURCE_TYPE_SELECT = [
        'question'  => 'Question',
        'reference' => 'Reference',
    ];

    public const SUBMIT_TYPE_SELECT = [
        'objective_question'  => 'Objective Question',
        'subjective_question' => 'Subjective Question',
        'attachment_question' => 'Attachment Question',
    ];

    public $table = 'post_contents';

    protected $appends = [
        'attachment',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'resource_type',
        'submit_type',
        'title',
        'desc',
        'mark',
        'required_response',
        'objective_selections',
        'objective_answers',
        'lesson_time_post_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment');
    }

    public function lesson_time_post()
    {
        return $this->belongsTo(LessonTimePost::class, 'lesson_time_post_id');
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
