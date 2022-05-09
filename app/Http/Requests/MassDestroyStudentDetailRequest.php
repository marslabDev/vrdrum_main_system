<?php

namespace App\Http\Requests;

use App\Models\StudentDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_details,id',
        ];
    }
}
