<?php

namespace App\Http\Requests;

use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentLessonProgressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_lesson_progress_create');
    }

    public function rules()
    {
        return [
            'progress' => [
                'string',
                'required',
            ],
        ];
    }
}
