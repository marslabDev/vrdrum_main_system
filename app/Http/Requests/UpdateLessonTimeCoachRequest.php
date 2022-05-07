<?php

namespace App\Http\Requests;

use App\Models\LessonTimeCoach;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonTimeCoachRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_time_coach_edit');
    }

    public function rules()
    {
        return [];
    }
}
