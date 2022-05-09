<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_create');
    }

    public function rules()
    {
        return [
            // 'no_of_class' => [
            //     'required',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
            'name' => [
                'string',
                'required',
            ],
            'syllabus' => [
                'string',
                'nullable',
            ],
        ];
    }
}
