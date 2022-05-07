<?php

namespace App\Http\Requests;

use App\Models\LessonTimeChange;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonTimeChangeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_time_change_edit');
    }

    public function rules()
    {
        return [
            'date_from' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'date_to' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'request_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'response_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
