<?php

namespace App\Http\Requests;

use App\Models\LessonLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_level_create');
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
        ];
    }
}
