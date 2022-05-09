<?php

namespace App\Http\Requests;

use App\Models\LessonTime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLessonTimeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lesson_time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lesson_times,id',
        ];
    }
}
