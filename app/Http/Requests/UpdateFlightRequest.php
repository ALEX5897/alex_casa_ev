<?php

namespace App\Http\Requests;

use App\Models\Flight;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFlightRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('flight_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'ruta' => [
                'string',
                'nullable',
            ],
            'pasajeros.*' => [
                'integer',
            ],
            'pasajeros' => [
                'array',
            ],
        ];
    }
}
