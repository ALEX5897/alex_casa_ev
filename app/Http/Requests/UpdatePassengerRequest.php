<?php

namespace App\Http\Requests;

use App\Models\Passenger;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePassengerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('passenger_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'dni' => [
                'string',
                'nullable',
            ],
            'vuelos.*' => [
                'integer',
            ],
            'vuelos' => [
                'array',
            ],
        ];
    }
}
