<?php

namespace App\Http\Requests;

use App\Models\WorkComment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkCommentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('work_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:work_comments,id',
        ];
    }
}
