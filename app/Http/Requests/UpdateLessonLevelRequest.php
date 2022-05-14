<?php

namespace App\Http\Requests;

use App\Models\LessonLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_level_edit');
    }

    public function rules()
    {
        return [
            'level' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'lesson_category_id' => [
                'required',
            ]
        ];
    }
}
