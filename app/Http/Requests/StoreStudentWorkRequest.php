<?php

namespace App\Http\Requests;

use App\Models\StudentWork;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_work_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'desc' => [
                'string',
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
            'time_given_minute' => [
                'numeric',
            ],
        ];
    }
}
