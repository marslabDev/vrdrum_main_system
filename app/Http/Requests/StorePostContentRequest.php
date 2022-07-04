<?php

namespace App\Http\Requests;

use App\Models\PostContent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostContentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_content_create');
    }

    public function rules()
    {
        return [
            'resource_type' => [
                'required',
            ],
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
            'objective_selections' => [
                'string',
                'nullable',
            ],
            'objective_answers' => [
                'string',
                'nullable',
            ],
            'lesson_time_post_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
