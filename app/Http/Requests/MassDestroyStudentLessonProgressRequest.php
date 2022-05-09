<?php

namespace App\Http\Requests;

use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentLessonProgressRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_lesson_progress_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_lesson_progresses,id',
        ];
    }
}
