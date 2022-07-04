<?php

namespace App\Http\Requests;

use App\Models\PostSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:post_submissions,id',
        ];
    }
}
