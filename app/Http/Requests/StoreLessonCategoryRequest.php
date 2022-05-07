<?php

namespace App\Http\Requests;

use App\Models\LessonCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'desc' => [
                'string',
                'nullable',
            ],
        ];
    }
}
