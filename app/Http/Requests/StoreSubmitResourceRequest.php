<?php

namespace App\Http\Requests;

use App\Models\SubmitResource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubmitResourceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('submit_resource_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'answer_text' => [
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
