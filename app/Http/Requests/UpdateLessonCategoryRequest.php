<?php

namespace App\Http\Requests;

use App\Models\LessonCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_category_edit');
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
