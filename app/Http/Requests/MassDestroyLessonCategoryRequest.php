<?php

namespace App\Http\Requests;

use App\Models\LessonCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLessonCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lesson_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lesson_categories,id',
        ];
    }
}
