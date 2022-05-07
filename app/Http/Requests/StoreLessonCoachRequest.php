<?php

namespace App\Http\Requests;

use App\Models\LessonCoach;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonCoachRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_coach_create');
    }

    public function rules()
    {
        return [];
    }
}
