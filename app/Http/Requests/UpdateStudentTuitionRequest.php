<?php

namespace App\Http\Requests;

use App\Models\StudentTuition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentTuitionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_tuition_edit');
    }

    public function rules()
    {
        return [
            'minute_left' => [
                'numeric',
                'required',
            ],
            'student_efk' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
