<?php

namespace App\Http\Requests;

use App\Models\StudentParent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentParentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_parent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_parents,id',
        ];
    }
}
