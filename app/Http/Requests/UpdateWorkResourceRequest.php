<?php

namespace App\Http\Requests;

use App\Models\WorkResource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkResourceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_resource_edit');
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
