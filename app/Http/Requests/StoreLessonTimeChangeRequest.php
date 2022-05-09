<?php

namespace App\Http\Requests;

use App\Models\LessonTimeChange;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonTimeChangeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_time_change_create');
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
            'request_user_efk' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'response_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'response_user_efk' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
