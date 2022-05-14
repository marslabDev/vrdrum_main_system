<?php

namespace App\Http\Requests;

use App\Models\LessonTime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonTimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_time_edit');
    }

    public function rules()
    {
        return [
            // 'lesson_code' => [
            //     'string',
            //     'required',
            // ],
            'date_from' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            // 'date_to' => [
            //     'required',
            //     'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            // ],
        ];
    }
}
