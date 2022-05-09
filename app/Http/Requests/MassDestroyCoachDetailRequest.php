<?php

namespace App\Http\Requests;

use App\Models\CoachDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCoachDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('coach_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:coach_details,id',
        ];
    }
}
