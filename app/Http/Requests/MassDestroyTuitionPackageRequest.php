<?php

namespace App\Http\Requests;

use App\Models\TuitionPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTuitionPackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tuition_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tuition_packages,id',
        ];
    }
}
