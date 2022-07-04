<?php

namespace App\Http\Requests;

use App\Models\PostSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePostSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_submission_edit');
    }

    public function rules()
    {
        return [
            'status' => [
                'string',
                'required',
            ],
            'submit_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'mark' => [
                'numeric',
            ],
            'mark_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'lesson_time_post_id' => [
                'required',
                'integer',
            ],
            'student_efk' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
