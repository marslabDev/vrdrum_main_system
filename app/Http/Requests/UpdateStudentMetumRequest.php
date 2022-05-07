<?php

namespace App\Http\Requests;

use App\Models\StudentMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentMetumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_metum_edit');
    }

    public function rules()
    {
        return [
            'meta_key' => [
                'string',
                'required',
            ],
            'meta_value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
