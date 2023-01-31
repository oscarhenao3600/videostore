@extends('vendor.components.modals.modal-standard')

@section('modal-id', $modal_target_name)
@section('modal-size', 'modal-lg')
@section('modal-header', 'Cargar clientes.')

@section('modal-body')
    <div class="row">
        <div class="col-12">
            <p>para realizar el registro de clientes es necesario descargar la la plantilla para luego cargarla. Descargue la plantilla haciendo click en el siguiente enlace <a href="{{ URL::asset('app/templates/upload-clients.xls') }}">aquí</a></p>
        </div>
    </div>

    <form action="{{ route('clients.import') }}" method="POST" id="frmData" class="mt-4" enctype="multipart/form-data">
        <input type="hidden" name="formType" id="formType" value="films-gender-add">
        @include('pages.clients.components.forms.upload-clients-form')
    </form>
@endsection

@section('modal-btn')
    <button type="button" class="btn btn-primary ml-1 btnAction" data-accion="clients" data-info="" data-formulario="#frmData" data-modal="#{{ $modal_target_name }}">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Cargar</span>
    </button>
@endsection