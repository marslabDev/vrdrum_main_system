<?php

namespace App\Http\Requests;

use App\Models\LessonCoach;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLessonCoachRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lesson_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lesson_coaches,id',
        ];
    }
}
