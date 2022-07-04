<?php

namespace App\Http\Requests;

use App\Models\PostContentSubmit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostContentSubmitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_content_submit_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'attachment' => [
                'array',
            ],
            'mark' => [
                'numeric',
            ],
            'objective_answers' => [
                'string',
                'nullable',
            ],
            'post_content_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
