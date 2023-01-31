@extends('vendor.components.modals.modal-standard')

@section('modal-id', $modal_target_name)
@section('modal-size', 'modal-lg')
@section('modal-header', 'Agregar nuevo tipo de película.')

@section('modal-body')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Se va crear un tipo de película.</p>
            <code>Nota: Los campos con * son requeridos.</code>
        </div>
    </div>

    <form action="{{ route('films.films_type.films_type_create') }}" method="POST" id="frmData" class="mt-4">
        <input type="hidden" name="formType" id="formType" value="film-type-create">
        @include('pages.films.components.forms.types-form')
    </form>
@endsection

@section('modal-btn')
    <button type="button" class="btn btn-primary ml-1 btnAction" data-accion="pelicula-tipo-genero" data-info="" data-formulario="#frmData" data-modal="#{{ $modal_target_name }}">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Agregar</span>
    </button>
@endsection