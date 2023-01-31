<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\PeliculaDato;
use App\Models\PeliculaGenero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

use App\Models\PeliculaTipo;

class ApiController extends Controller
{

    public function get_modal(Request $request)
    {
        $modal_tipo = $request->input('target');
        $item_info = $request->input('item_info');
        $modal_target_name = str_replace('#', '', $modal_tipo);
        $modal_view = null;

        if($item_info != null)
        {
            $item_info = Crypt::decrypt($item_info);
        }

        switch($modal_target_name)
        {
            case 'films-delete-modal':
                $modal = 'pages.films.components.modals.film-delete-modal';
                $film_data = PeliculaDato::find($item_info);

                $modal_view = View::make($modal, compact('modal_target_name', 'film_data'))->render();
            break;

            case 'films-type-add-modal':
            case 'films-type-edit-modal':
                $modal = 'pages.films.components.modals.type-create-modal';
                $film_type = new PeliculaTipo();

                if($modal_target_name === 'films-type-edit-modal')
                {
                    $modal = 'pages.films.components.modals.type-edit-modal';
                    $film_type = PeliculaTipo::find($item_info);
                }

                $modal_view = View::make($modal, compact('modal_target_name', 'film_type'))->render();
            break;

            case 'films-gender-add-modal':
            case 'films-gender-edit-modal':
                $modal = 'pages.films.components.modals.gender-create-modal';
                $film_gender = new PeliculaGenero();
    
                if($modal_target_name === 'films-gender-edit-modal')
                {
                    $modal = 'pages.films.components.modals.gender-edit-modal';
                    $film_gender = PeliculaGenero::find($item_info);
                }
    
                $modal_view = View::make($modal, compact('modal_target_name', 'film_gender'))->render();
            break;

            case 'clients-upload-modal':
                $modal = 'pages.clients.components.modals.client-upload-modal';

                $modal_view = View::make($modal, compact('modal_target_name'))->render();
            break;

            case 'rental-delete-modal':
                $modal = 'pages.rental.components.modals.rental-delete';
                $rental = Alquiler::find($item_info);

                $modal_view = View::make($modal, compact('modal_target_name', 'rental'))->render();
            break;

            default:
                $modal = 'vendor.messages.opcion-invalida';

                $modal_view = View::make($modal, compact('modal_target_name'))->render();
            break;
        }

        return response()
                ->json(
                    [
                        'status' => 'ok',
                        'modal_id' => '#' . $modal_target_name,
                        'modal_web' => $modal_view
                    ], 200
                );
    }

}
