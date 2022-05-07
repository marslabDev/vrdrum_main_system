<?php

namespace App\Http\Requests;

use App\Models\WorkResource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkResourceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_resource_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'question_text' => [
                'string',
                'nullable',
            ],
            'url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
