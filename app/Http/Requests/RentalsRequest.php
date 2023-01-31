<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RentalsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $formType = Request::input('formType');

        switch($formType)
        {
            case 'rental-add-film':
                return [
                    'pelicula_dato' => 'required'
                ];
            break;

            case 'rental-update-film':
                return [
                    'pelicula_dato_alquiler_fecha_inicio' => 'required|date_format:Y-m-d',
                    'pelicula_dato_alquiler_fecha_fin' => 'required|date_format:Y-m-d',
                ];
            break;

            case 'rental-save':
                return [
                    'cliente_dato_num_identificacion' => 'required'
                ];
            break;
        }
    }
}
