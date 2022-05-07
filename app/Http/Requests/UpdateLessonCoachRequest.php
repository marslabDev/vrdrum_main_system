<?php

namespace App\Http\Requests;

use App\Models\LessonCoach;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonCoachRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_coach_edit');
    }

    public function rules()
    {
        return [];
    }
}
