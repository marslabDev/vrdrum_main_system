<?php

namespace App\Http\Requests;

use App\Models\StudentDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_detail_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'parent_name' => [
                'string',
                'nullable',
            ],
            'parent_phone' => [
                'string',
                'nullable',
            ],
            'lesson_categories' => [
                'required',
            ],
            'lesson_group' => [
                'required',
            ],
            'is_disabled' => [
                'required',
            ],
        ];
    }
}
