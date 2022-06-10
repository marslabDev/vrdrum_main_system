<?php

namespace App\Http\Requests;

use App\Models\StudentDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_detail_edit');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'nullable',
            ],
            'home_address' => [
                'string',
                'nullable',
            ],
            'mail_address' => [
                'string',
                'required',
            ],
            'state' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'postcode' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone' => [
                'string',
                'nullable',
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
