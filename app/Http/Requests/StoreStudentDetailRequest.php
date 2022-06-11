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
            'nric_no' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'guardians.*' => [
                'integer',
            ],
            'guardians' => [
                'array',
            ],
        ];
    }
}
