<?php

namespace App\Http\Requests;

use App\Models\ClassRoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClassRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('class_room_edit');
    }

    public function rules()
    {
        return [
            'room_title' => [
                'string',
                'required',
            ],
            'is_available' => [
                'required',
            ],
            'branch_efk' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
