<?php

namespace App\Http\Requests;

use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentLessonProgressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_lesson_progress_edit');
    }

    public function rules()
    {
        return [
            'progress' => [
                'string',
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
