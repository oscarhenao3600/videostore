<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalsRequest;
use App\Models\Alquiler;
use App\Models\ClienteDato;
use App\Models\PeliculaDato;
use App\Models\PeliculaDatoAlquiler;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RentalsController extends Controller
{

    public $view_load;

    function __construct()
    {
        if(!Session::has('films'))
            Session::put('films', array());

        $this->view_load = View::make('vendor.messages.loading-data');
    }

    public function index()
    {
        return View::make('pages.rental.details', ['view_load' => $this->view_load]);
    }

    public function rentals_create()
    {
        Session::forget('films');

        $alquiler = new Alquiler();
        $cliente_dato = new ClienteDato();
        $peliculas_datos_alquileres = new PeliculaDatoAlquiler();
        
        $clientes_datos = ClienteDato::GetInfo()->get();
        $films_data = PeliculaDato::Getinfo()->get();

        return View::make('pages.rental.create-rental', 
                                        [
                                            'view_load' => $this->view_load,
                                            'alquiler' => $alquiler,
                                            'cliente_dato' => $cliente_dato,
                                            'peliculas_datos_alquileres' => $peliculas_datos_alquileres,
                                            'clientes_datos' => $clientes_datos,
                                             'films_data' => $films_data]);
    }

    public function rentals_create_process(Request $request)
    {
        $txt_cliente_dato_num_identificacion = $request->input('cliente_dato_num_identificacion');
        $cliente_dato = ClienteDato::Getinfo(null, $txt_cliente_dato_num_identificacion)->first();
        $films = Session::get('films');

        if($cliente_dato)
        {
            if(count($films) > 0)
            {
                $rental = new Alquiler();
                $rental->cliente_dato_id = $cliente_dato->id;
                $rental->updated_at = null;
                $rental->save();

                foreach($films as $film)
                {
                    $film_data_rental = new PeliculaDatoAlquiler();
                    $film_data_rental->alquiler_id = $rental->id;
                    $film_data_rental->pelicula_dato_id = $film->id;
                    $film_data_rental->pelicula_dato_alquiler_fecha_inicio = $film->pelicula_dato_alquiler_fecha_inicio;
                    $film_data_rental->pelicula_dato_alquiler_fecha_fin = $film->pelicula_dato_alquiler_fecha_fin;
                    $film_data_rental->pelicula_dato_alquiler_valor_pagar = $film->pelicula_dato_alquiler_valor_sub_total;
                    $film_data_rental->updated_at = null;
                    $film_data_rental->save();
                }

                Session::forget('films');

                return response()->json(
                    [
                        'status' => 'ok',
                        'message_status' => 'success',
                        'title' => 'Alquiler de películas',
                        'message' => 'Se alquiló la(s) películas al cliente ' . $cliente_dato->cliente_dato_nombres,
                        'route' => route('rental.rental_list')
                    ], 200
                );
            }

            return response()->json(
                [
                    'status' => 'error',
                    'message_status' => 'warning',
                    'title' => 'Alquiler de películas',
                    'message' => 'Las lista de películas esta vacía',
                ], 200
            );
        }

        return response()->json(
            [
                'status' => 'error',
                'message_status' => 'warning',
                'title' => 'Alquiler de películas',
                'message' => 'Por favor seleccione un cliente',
            ], 200
        );
    }

    public function rentals_edit($id)
    {
        Session::forget('films');

        $alquiler = Alquiler::find($id);
        $cliente_dato = $alquiler->cliente_dato;
        $this->film_load_data($alquiler->peliculas_datos_alquileres);

        $clientes_datos = ClienteDato::GetInfo()->get();
        $films_data = PeliculaDato::Getinfo()->get();

        return View::make('pages.rental.edit-rental', 
                                        [
                                            'view_load' => $this->view_load,
                                            'alquiler' => $alquiler,
                                            'cliente_dato' => $cliente_dato,
                                            'clientes_datos' => $clientes_datos,
                                             'films_data' => $films_data]);
    }

    public function rentals_edit_process(Request $request, $id)
    {
        $txt_cliente_dato_num_identificacion = $request->input('cliente_dato_num_identificacion');
        $cliente_dato = ClienteDato::Getinfo(null, $txt_cliente_dato_num_identificacion)->first();
        $films = Session::get('films');

        if($cliente_dato)
        {
            if(count($films) > 0)
            {
                $rental = Alquiler::find($id);
                $rental->cliente_dato_id = $cliente_dato->id;
                $rental->updated_at = null;
                $rental->save();

                $peliculas_datos_alquileres = PeliculaDatoAlquiler::GetInfo(null, $rental->id)->get();

                if($peliculas_datos_alquileres->count() > 0)
                {
                    PeliculaDatoAlquiler::GetInfo(null, $rental->id)->delete();
                }

                foreach($films as $film)
                {
                    $film_data_rental = new PeliculaDatoAlquiler();
                    $film_data_rental->alquiler_id = $rental->id;
                    $film_data_rental->pelicula_dato_id = $film->id;
                    $film_data_rental->pelicula_dato_alquiler_fecha_inicio = $film->pelicula_dato_alquiler_fecha_inicio;
                    $film_data_rental->pelicula_dato_alquiler_fecha_fin = $film->pelicula_dato_alquiler_fecha_fin;
                    $film_data_rental->pelicula_dato_alquiler_valor_pagar = $film->pelicula_dato_alquiler_valor_sub_total;
                    $film_data_rental->updated_at = null;
                    $film_data_rental->save();
                }

                Session::forget('films');

                return response()->json(
                    [
                        'status' => 'ok',
                        'message_status' => 'success',
                        'title' => 'Alquiler de películas',
                        'message' => 'Se alquiló la(s) películas al cliente ' . $cliente_dato->cliente_dato_nombres,
                        'route' => route('rental.rental_list')
                    ], 200
                );
            }

            return response()->json(
                [
                    'status' => 'error',
                    'message_status' => 'warning',
                    'title' => 'Alquiler de películas',
                    'message' => 'Las lista de películas esta vacía',
                ], 200
            );
        }

        return response()->json(
            [
                'status' => 'error',
                'message_status' => 'warning',
                'title' => 'Alquiler de películas',
                'message' => 'Por favor seleccione un cliente',
            ], 200
        );
    }

    public function rentals_delete($id)
    {
        $rental = Alquiler::find($id);
        $rental_id = $rental->idate;
        $msg = $rental->delete() ? 'Se ha eliminado el alquiler # ' . $rental_id : 'No se pudo eliminar eliminar la #' . $rental_id;

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'action' => 'delete',
                        'message_status' => 'warning',
                        'title' => 'Películas',
                        'message' => $msg,
                        'route' => route('films.index'),
                    ], 200
                );
    }

    public function get_rentals()
    {
        $rentals = Alquiler::GetInfo()->paginate(50);
        $rentals->withPath(route('rental.get_rentals'));
        $view = count($rentals) > 0 ? 'pages.rental.components.lists.rentals-list' : 'vendor.messages.empty-data';

        return response()
                ->json([
                        'status' => 'ok',
                        'view' => View::make($view, compact('rentals'))->render()
                    ], 200);
    }

    /* Films cart session */
    public function film_view_added($ajax = 'no')
    {
        $films = Session::get('films');

        if(count($films) == 0 || $films == null)
        {
            if($ajax === 'ajax')
            {
                return response()->json(
                    [
                        'status' => 'ok',
                        'message_status' => 'warning',
                        'title' => 'Alquiler de películas',
                        'message' => 'No hay películas agregadas',
                        'total' => count($films),
                        'view' => View::make('pages.rental.messages.empty-films-selected')->render()
                    ], 200
                );
            }

            return View::make('pages.rental.messages.empty-films-selected');
        }

        $total_pay = 0;

        foreach($films as $film)
        {
            $total_pay += $film->pelicula_dato_alquiler_valor_sub_total;
        }

        if($ajax === 'ajax')
        {
            return response()->json(
                [
                    'status' => 'ok',
                    'total' => count($films),
                    'view' => View::make('pages.rental.components.lists.rental-data-films', compact('films', 'total_pay'))->render()
                ], 200
            );
        }

        return View::make('pages.rental.components.lists.rental-data-films', compact('films', 'total_pay'));
    }

    public function film_add(RentalsRequest $request)
    {
        $films = Session::get('films');
        $film = $request->input('pelicula_dato');
        $fil_array = explode(' - ', $film);
        $film_id = $fil_array[0];
        $film_name = $fil_array[1];
        $msg = 'No se ha podido agregar la película';

        $film_data = PeliculaDato::GetInfo($film_id)->first();

        if($film_data)
        {
            if(find_by_data($films, 'id', $film_id))
            {
                $msg = 'Película ' . $film_name . ' esta en la lista';

                return response()->json(
                    [
                        'status' => 'error',
                        'message_status' => 'warning',
                        'title' => 'Alquiler de películas',
                        'message' => $msg,
                    ], 200
                );
            }

            $date_start = fecha_actual()->format('Y-m-d');
            $date_end = fecha_actual()->addDays(1)->format('Y-m-d');
            $num_days = count_days_different($date_start, $date_end);

            $film_data->pelicula_dato_alquiler_fecha_inicio = $date_start;
            $film_data->pelicula_dato_alquiler_fecha_fin = $date_end;
            $film_data->pelicula_dato_alquiler_num_dias = $num_days;
            $film_data->pelicula_dato_alquiler_dia_adicional_desde = $film_data->pelicula_tipo->pelicula_tipo_dia_adicional_desde;
            $film_data->pelicula_dato_alquiler_dia_porcent_adicional = $film_data->pelicula_tipo->pelicula_tipo_porcent_dia_adicional;
            $film_data->pelicula_dato_alquiler_valor_sub_total = totalPayRentalFilms($film_data->pelicula_dato_precio_unitario, $num_days, $film_data->pelicula_dato_alquiler_dia_adicional_desde, $film_data->pelicula_dato_alquiler_dia_porcent_adicional);

            $films[$film_data->id] = $film_data;
            Session::put('films', $films);
            $msg = 'Película ' . $film_name . ' agregada';
        }

        return response()->json(
            [
                'status' => 'ok',
                'message_status' => 'success',
                'title' => 'Alquiler de películas',
                'message' => $msg,
                'view' => $this->film_view_added()->render()
            ], 200
        );
    }

    public function film_change_dates(RentalsRequest $request)
    {
        $films = Session::get('films');
        $film_id = $request->input('pelicula_dato');
        $msg = 'No hay películas seleccionadas';

        if(find_by_data($films, 'id', $film_id))
        {
            $txt_pelicula_dato_alquiler_fecha_inicio = $request->input('pelicula_dato_alquiler_fecha_inicio');
            $txt_pelicula_dato_alquiler_fecha_fin = $request->input('pelicula_dato_alquiler_fecha_fin');

            $num_days = count_days_different($txt_pelicula_dato_alquiler_fecha_inicio, $txt_pelicula_dato_alquiler_fecha_fin);

            $film_data = $films[$film_id];
            $film_data->pelicula_dato_alquiler_fecha_inicio = $txt_pelicula_dato_alquiler_fecha_inicio;
            $film_data->pelicula_dato_alquiler_fecha_fin = $txt_pelicula_dato_alquiler_fecha_fin;
            $film_data->pelicula_dato_alquiler_num_dias = count_days_different($film_data->pelicula_dato_alquiler_fecha_inicio, $film_data->pelicula_dato_alquiler_fecha_fin);
            $film_data->pelicula_dato_alquiler_valor_sub_total = totalPayRentalFilms($film_data->pelicula_dato_precio_unitario, $num_days, $film_data->pelicula_dato_alquiler_dia_adicional_desde, $film_data->pelicula_dato_alquiler_dia_porcent_adicional);;

            $films[$film_id] = $film_data;
            Session::put('films', $films);

            $msg = 'Información actualizada';
        }

        return response()->json(
            [
                'status' => 'ok',
                'message_status' => 'success',
                'title' => 'Alquiler de películas',
                'message' => $msg,
                'view' => $this->film_view_added()->render(),
            ], 200
        );
    }

    public function film_remove(Request $request)
    {
        $films = Session::get('films');
        unset($films[$request->input('pelicula_dato')]);
        Session::put('films', $films);

        return response()->json(
            [
                'status' => 'ok',
                'message_status' => 'warning',
                'title' => 'Alquiler de películas',
                'message' => 'Película eliminada',
                'view' => $this->film_view_added()->render(),
            ], 200
        );
    }

    private function film_load_data($films_data_rentails)
    {
        $films = Session::get('films');

        foreach($films_data_rentails as $film_data_rentail)
        {
            $film_data = $film_data_rentail->pelicula_dato;
            $date_start = $film_data_rentail->pelicula_dato_alquiler_fecha_inicio;
            $date_end = $film_data_rentail->pelicula_dato_alquiler_fecha_fin;
            $num_days = count_days_different($date_start, $date_end);

            $film_data->pelicula_dato_alquiler_fecha_inicio = $date_start;
            $film_data->pelicula_dato_alquiler_fecha_fin = $date_end;
            $film_data->pelicula_dato_alquiler_num_dias = $num_days;
            $film_data->pelicula_dato_alquiler_dia_adicional_desde = $film_data->pelicula_tipo->pelicula_tipo_dia_adicional_desde;
            $film_data->pelicula_dato_alquiler_dia_porcent_adicional = $film_data->pelicula_tipo->pelicula_tipo_porcent_dia_adicional;
            $film_data->pelicula_dato_alquiler_valor_sub_total = totalPayRentalFilms($film_data->pelicula_dato_precio_unitario, $num_days, $film_data->pelicula_dato_alquiler_dia_adicional_desde, $film_data->pelicula_dato_alquiler_dia_porcent_adicional);
            $films[$film_data->id] = $film_data;

            Session::put('films', $films);
        }
    }

}
