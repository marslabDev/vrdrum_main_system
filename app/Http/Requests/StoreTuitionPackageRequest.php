<?php

namespace App\Http\Requests;

use App\Models\TuitionPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTuitionPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tuition_package_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'total_minute' => [
                'numeric',
                'required',
            ],
        ];
    }
}
