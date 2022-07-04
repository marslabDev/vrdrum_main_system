<?php

namespace App\Http\Requests;

use App\Models\PostComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_comment_create');
    }

    public function rules()
    {
        return [
            'lesson_time_post_id' => [
                'required',
                'integer',
            ],
            'sender_efk' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
