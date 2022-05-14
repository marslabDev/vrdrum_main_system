<?php

namespace App\Http\Requests;

use App\Models\SubmitResource;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubmitResourceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('submit_resource_edit');
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
        ];
    }
}
