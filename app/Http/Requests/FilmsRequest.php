<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FilmsRequest extends FormRequest
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
            case 'film-create':
                return [
                    'pelicula_dato_nombre' => 'required|max:250|unique:peliculas_datos',
                    'pelicula_dato_fecha_estreno' => 'required|date_format:Y-m-d',
                    'pelicula_dato_precio_unitario' => 'required|integer|min:0',
                    'pelicula_tipo_id' => 'required|not_in:-1',
                    'pelicula_dato_sinopsis' => 'required|min:5|max:3000',
                    'peliculas_generos_datos' => 'required|array',
                ];
            break;

            case 'film-edit':
                return [
                    'pelicula_dato_nombre' => 'required|max:250|unique:peliculas_datos,id,' . Request::input('pelicula_dato_nombre'),
                    'pelicula_dato_fecha_estreno' => 'required|date_format:Y-m-d',
                    'pelicula_dato_precio_unitario' => 'required|integer|min:0',
                    'pelicula_tipo_id' => 'required|not_in:-1',
                    'pelicula_dato_sinopsis' => 'required|min:5|max:3000',
                    'peliculas_generos_datos' => 'required|array',
                ];
            break;

            case 'film-type-create':
                return [
                    'pelicula_tipo_nombre' => 'required|max:40|unique:peliculas_tipos',
                    'pelicula_tipo_dia_adicional_desde' => 'required|integer|min:0',
                    'pelicula_tipo_porcent_dia_adicional' => 'required|integer|min:0|max:100',
                ];
            break;

            case 'film-type-edit':
                return [
                    'pelicula_tipo_nombre' => 'required|max:40|unique:peliculas_tipos,id,' . Request::input('pelicula_tipo_nombre'),
                    'pelicula_tipo_dia_adicional_desde' => 'required|integer|min:0',
                    'pelicula_tipo_porcent_dia_adicional' => 'required|integer|min:0|max:100',
                ];
            break;


            case 'films-gender-add':
                return [
                    'pelicula_genero_nombre' => 'required|max:60|unique:peliculas_generos'
                ];
            break;


            case 'films-gender-edit':
                return [
                    'pelicula_genero_nombre' => 'required|max:60|unique:peliculas_generos,id,' . Request::input('pelicula_genero_nombre')
                ];
            break;
        }
        
    }
}
