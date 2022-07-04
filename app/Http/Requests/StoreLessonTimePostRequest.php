<?php

namespace App\Http\Requests;

use App\Models\LessonTimePost;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonTimePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_time_post_create');
    }

    public function rules()
    {
        return [
            'group' => [
                'string',
                'required',
            ],
            'category' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'publish_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'terminate_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'start_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'end_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'lesson_time_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
