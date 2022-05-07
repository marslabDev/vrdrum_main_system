<?php

namespace App\Http\Requests;

use App\Models\StudentMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_meta,id',
        ];
    }
}
