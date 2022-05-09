<?php

namespace App\Http\Requests;

use App\Models\CoachDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCoachDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coach_detail_create');
    }

    public function rules()
    {
        return [
            'enrollment_status' => [
                'required',
            ],
            'coach_efk' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
