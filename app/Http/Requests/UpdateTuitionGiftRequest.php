<?php

namespace App\Http\Requests;

use App\Models\TuitionGift;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTuitionGiftRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tuition_gift_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'total_minute' => [
                'numeric',
            ],
            'quantity' => [
                'numeric',
            ],
            'inventory_efk' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
