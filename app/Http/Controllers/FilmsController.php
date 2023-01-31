<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsRequest;
use Illuminate\Support\Facades\View;

use App\Models\PeliculaDato;
use App\Models\PeliculaGenero;
use App\Models\PeliculaGeneroDato;
use App\Models\PeliculaTipo;

class FilmsController extends Controller
{

    public $view_load;

    function __construct()
    {
        $this->view_load = View::make('vendor.messages.loading-data');
    }

    public function index()
    {
        return View::make('pages.films.list-films', ['view_load' => $this->view_load]);
    }

    public function films_create()
    {
        $film_data = new PeliculaDato();
        $film_types = PeliculaTipo::Getinfo()->get();
        $film_genders = PeliculaGenero::Getinfo()->get();

        return View::make('pages.films.create-film', compact('film_data', 'film_types', 'film_genders'));
    }

    public function films_create_process(FilmsRequest $request)
    {
        $txt_pelicula_dato_nombre = $request->input('pelicula_dato_nombre');
        $txt_pelicula_dato_sinopsis = $request->input('pelicula_dato_sinopsis');
        $txt_pelicula_dato_precio_unitario = $request->input('pelicula_dato_precio_unitario');
        $txt_pelicula_dato_fecha_estreno = $request->input('pelicula_dato_fecha_estreno');
        $cbo_pelicula_tipo_id = $request->input('pelicula_tipo_id');
        $chk_peliculas_generos_datos = $request->input('peliculas_generos_datos');

        $film_data = new PeliculaDato();
        $film_data->pelicula_dato_nombre = $txt_pelicula_dato_nombre;
        $film_data->pelicula_dato_sinopsis = $txt_pelicula_dato_sinopsis;
        $film_data->pelicula_dato_precio_unitario = $txt_pelicula_dato_precio_unitario;
        $film_data->pelicula_dato_fecha_estreno = $txt_pelicula_dato_fecha_estreno;
        $film_data->pelicula_tipo_id = $cbo_pelicula_tipo_id;
        $film_data->updated_at = null;
        $film_data->save();

        if(count($chk_peliculas_generos_datos) > 0)
        {
            foreach($chk_peliculas_generos_datos as $chk_pelicula_genero_dato)
            {
                $pelicula_genero_dato = new PeliculaGeneroDato();
                $pelicula_genero_dato->pelicula_dato_id = $film_data->id;
                $pelicula_genero_dato->pelicula_genero_id = $chk_pelicula_genero_dato;
                $pelicula_genero_dato->updated_at = null;
                $pelicula_genero_dato->save();
            }
        }

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'create',
                        'route' => route('films.films_create'),
                        'data' => $film_data,
                    ], 200
                );
    }

    public function films_edit($id)
    {
        $film_data = PeliculaDato::find($id);
        $film_types = PeliculaTipo::Getinfo()->get();
        $film_genders = PeliculaGenero::Getinfo()->get();

        return View::make('pages.films.edit-film', compact('film_data', 'film_types', 'film_genders'));
    }

    public function films_edit_process(FilmsRequest $request, $id)
    {
        $txt_pelicula_dato_nombre = $request->input('pelicula_dato_nombre');
        $txt_pelicula_dato_sinopsis = $request->input('pelicula_dato_sinopsis');
        $txt_pelicula_dato_precio_unitario = $request->input('pelicula_dato_precio_unitario');
        $txt_pelicula_dato_fecha_estreno = $request->input('pelicula_dato_fecha_estreno');
        $cbo_pelicula_tipo_id = $request->input('pelicula_tipo_id');
        $chk_peliculas_generos_datos = $request->input('peliculas_generos_datos');

        $film_data = PeliculaDato::find($id);
        $film_data->pelicula_dato_nombre = $txt_pelicula_dato_nombre;
        $film_data->pelicula_dato_sinopsis = $txt_pelicula_dato_sinopsis;
        $film_data->pelicula_dato_precio_unitario = $txt_pelicula_dato_precio_unitario;
        $film_data->pelicula_dato_fecha_estreno = $txt_pelicula_dato_fecha_estreno;
        $film_data->pelicula_tipo_id = $cbo_pelicula_tipo_id;
        $film_data->save();

        $get_pelicula_genero_dato = PeliculaGeneroDato::GetInfo(null, $film_data->id)->get();

        if(count($get_pelicula_genero_dato) > 0)
        {
            PeliculaGeneroDato::GetInfo(null, $film_data->id)->delete();
        }

        if(!empty($chk_peliculas_generos_datos))
        {
            foreach($chk_peliculas_generos_datos as $chk_pelicula_genero_dato)
            {
                $pelicula_genero_dato = new PeliculaGeneroDato();
                $pelicula_genero_dato->pelicula_dato_id = $film_data->id;
                $pelicula_genero_dato->pelicula_genero_id = $chk_pelicula_genero_dato;
                $pelicula_genero_dato->updated_at = null;
                $pelicula_genero_dato->save();
            }
        }

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'update',
                        'route' => route('films.films_edit', [$film_data->id]),
                        'data' => $film_data,
                    ], 200
                );
    }

    public function films_delete($id)
    {
        $film_data = PeliculaDato::find($id);
        $txt_pelicula_dato_nombre = $film_data->pelicula_dato_nombre;
        $msg = $film_data->delete() ? 'Se ha eliminado la película ' . $txt_pelicula_dato_nombre : 'No se pudo eliminar la peícula ' . $txt_pelicula_dato_nombre;

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'delete',
                        'message_status' => 'warning',
                        'title' => 'Películas',
                        'message' => 'La película ' . $txt_pelicula_dato_nombre . ' fue eliminada.',
                        'route' => route('films.index'),
                    ], 200
                );
    }

    public function films_get_data()
    {
        $films = PeliculaDato::GetInfo()->paginate(50);
        $films->withPath(route('films.films_get_data'));
        $view = count($films) > 0 ? 'pages.films.components.lists.films-list' : 'vendor.messages.empty-data';

        return response()
                ->json([
                        'status' => 'ok',
                        'view' => View::make($view, compact('films'))->render()
                    ], 200);
    }

    /** 
     * Functions for types
     * CRUD
     **/
    public function films_type_list()
    {
        return View::make('pages.films.list-type', ['view_load' => $this->view_load]);
    }

    public function films_type_create(FilmsRequest $request)
    {
        $txt_pelicula_tipo_nombre = $request->input('pelicula_tipo_nombre');
        $txt_pelicula_tipo_dia_adicional_desde = $request->input('pelicula_tipo_dia_adicional_desde');
        $txt_pelicula_tipo_porcent_dia_adicional = $request->input('pelicula_tipo_porcent_dia_adicional');

        $film_type = new PeliculaTipo();
        $film_type->pelicula_tipo_nombre = $txt_pelicula_tipo_nombre;
        $film_type->pelicula_tipo_dia_adicional_desde = $txt_pelicula_tipo_dia_adicional_desde;
        $film_type->pelicula_tipo_porcent_dia_adicional = $txt_pelicula_tipo_porcent_dia_adicional;
        $film_type->updated_at = null;
        $film_type->save();

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'create',
                        'message_status' => 'success',
                        'title' => 'Películas - Tipos',
                        'message' => 'El tipo de ' . $txt_pelicula_tipo_nombre . ' fue agregadó.',
                        'data' => $film_type
                    ], 200
                );
    }

    public function films_type_edit(FilmsRequest $request, $id)
    {
        $txt_pelicula_tipo_nombre = $request->input('pelicula_tipo_nombre');
        $txt_pelicula_tipo_dia_adicional_desde = $request->input('pelicula_tipo_dia_adicional_desde');
        $txt_pelicula_tipo_porcent_dia_adicional = $request->input('pelicula_tipo_porcent_dia_adicional');

        $film_type = PeliculaTipo::find($id);
        $film_type->pelicula_tipo_nombre = $txt_pelicula_tipo_nombre;
        $film_type->pelicula_tipo_dia_adicional_desde = $txt_pelicula_tipo_dia_adicional_desde;
        $film_type->pelicula_tipo_porcent_dia_adicional = $txt_pelicula_tipo_porcent_dia_adicional;
        $film_type->save();

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'update',
                        'message_status' => 'warning',
                        'title' => 'Películas - Tipos',
                        'message' => 'El tipo de ' . $txt_pelicula_tipo_nombre . ' fue modificado.',
                        'data' => $film_type
                    ], 200
                );
    }

    public function films_type_get_data()
    {
        $types = PeliculaTipo::GetInfo()->get();
        $view = count($types) > 0 ? 'pages.films.components.lists.types-list' : 'vendor.messages.empty-data';

        return response()
                ->json([
                        'status' => 'ok',
                        'view' => View::make($view, compact('types'))->render()
                    ], 200);
    }

    /** 
     * Functions for genders
     * CRUD
     **/
    public function films_genders_list()
    {
        return View::make('pages.films.list-gender', ['view_load' => $this->view_load]);
    }

    public function films_genders_create(FilmsRequest $request)
    {
        $txt_pelicula_genero_nombre = $request->input('pelicula_genero_nombre');

        $film_gender = new PeliculaGenero();
        $film_gender->pelicula_genero_nombre = $txt_pelicula_genero_nombre;
        $film_gender->updated_at = null;
        $film_gender->save();

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'create',
                        'message_status' => 'success',
                        'title' => 'Películas - Generós',
                        'message' => 'El género de ' . $txt_pelicula_genero_nombre . ' fue creado.',
                        'data' => $film_gender
                    ], 200
                );
    }

    public function films_genders_edit(FilmsRequest $request, $id)
    {
        $txt_pelicula_genero_nombre = $request->input('pelicula_genero_nombre');

        $film_gender = PeliculaGenero::find($id);
        $film_gender->pelicula_genero_nombre = $txt_pelicula_genero_nombre;
        $film_gender->save();

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'update',
                        'message_status' => 'warning',
                        'title' => 'Películas - Generós',
                        'message' => 'El género de ' . $txt_pelicula_genero_nombre . ' fue modificado.',
                        'data' => $film_gender
                    ], 200
                );
    }

    public function films_genders_get_data()
    {
        $genders = PeliculaGenero::GetInfo()->get();
        $view = count($genders) > 0 ? 'pages.films.components.lists.genders-list' : 'vendor.messages.empty-data';

        return response()
                ->json([
                        'status' => 'ok',
                        'view' => View::make($view, compact('genders'))->render()
                    ], 200);
    }

}
