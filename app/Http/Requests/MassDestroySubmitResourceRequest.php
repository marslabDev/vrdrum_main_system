<?php

namespace App\Http\Requests;

use App\Models\SubmitResource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubmitResourceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('submit_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:submit_resources,id',
        ];
    }
}
