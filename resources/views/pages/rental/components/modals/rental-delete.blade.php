@extends('vendor.components.modals.modal-standard')

@section('modal-id', $modal_target_name)
@section('modal-size', 'modal-lg')
@section('modal-header', 'Eliminar alquiler.')

@section('modal-body')
    <form action="{{ route('rental.rentals_delete', [$rental->id]) }}" method="DELETE" id="frmData" class="">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>Esta apunto de eliminar el alquiler #{{ $rental->id }} vinculado al cliente <strong>{{ $rental->cliente_dato->cliente_dato_nombres . ' ' . $rental->cliente_dato->cliente_dato_apellidos }}</strong> con número de identificación {{ $rental->cliente_dato->cliente_dato_num_identificacion }}.</p>
                <p>La renta tiene agregada {{ count($rental->peliculas_datos_alquileres) }} películas</p>
                <p>
                    ¿Está seguro/a de realizar esta accción?<br>
                    Sí, esta seguro/a presiona el botón eliminar
                </p>
            </div>
        </div>
    </form>
@endsection

@section('modal-btn')
    <button type="button" class="btn btn-danger ml-1 btnAction" data-accion="pelicula-tipo-genero" data-info="" data-formulario="#frmData" data-modal="#{{ $modal_target_name }}">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Eliminar</span>
    </button>
@endsection