@extends('vendor.template.master')

@section('page-title', 'Agregar')

@section('page-content-breadcrumb')
    <div class="mt-1">
        <nav aria-label="breadcrumb">
            <ul class="breadcrumbs">
                <li class="first">
                    <a href="{{ route('home.index') }}">
                        <i class="fa fa-solid fa-house"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('films.index') }}">Películas</a>
                </li>
                <li class="last active">
                    <a href="#">@yield('page-title')</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection

@section('page-content-body')

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('films.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    Regresar
                </a>
            </div>

            <div class="col-12">
                <hr />
            </div>
        </div>
        
        <form action="{{ route('films.films_create_process') }}" method="POST" id="frmData" class="mt-2">
            <input type="hidden" name="formType" id="formType" value="film-create">
            @include('pages.films.components.forms.films-form')
        </form>

        <div class="row mt-4">
            <div class="col-12">
                <button class="btn btn-info btnAction" data-accion="pelicula-dato" data-formulario="#frmData">
                    Agregar
                </button>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    <link href="{{ URL::asset('content/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
@endsection

@section('page-scripts')
    <script src="{{ URL::asset('content/common/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('content/vendor/daterangepicker/daterangepicker.js') }}"></script>
@endsection