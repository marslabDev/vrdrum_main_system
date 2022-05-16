<?php

namespace App\Http\Requests;

use App\Models\WorkComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_comment_edit');
    }

    public function rules()
    {
        return [
            'content' => [
                'string',
                'required',
            ],
            'sender_efk' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
