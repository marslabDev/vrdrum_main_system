<?php

namespace App\Http\Requests;

use App\Models\StudentParent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentParentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_parent_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'nationality' => [
                'string',
                'nullable',
            ],
            'relationship' => [
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'nric_no' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
