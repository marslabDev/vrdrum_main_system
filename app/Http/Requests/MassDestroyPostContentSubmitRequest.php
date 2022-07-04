<?php

namespace App\Http\Requests;

use App\Models\PostContentSubmit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostContentSubmitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_content_submit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:post_content_submits,id',
        ];
    }
}
