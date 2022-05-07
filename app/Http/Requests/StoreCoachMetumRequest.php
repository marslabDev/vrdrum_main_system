<?php

namespace App\Http\Requests;

use App\Models\CoachMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCoachMetumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coach_metum_create');
    }

    public function rules()
    {
        return [
            'meta_key' => [
                'string',
                'required',
            ],
            'meta_value' => [
                'string',
                'nullable',
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
