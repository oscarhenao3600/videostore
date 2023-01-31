@extends('vendor.template.master')

@section('page-title', 'Nuevo alquiler')

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
                    <a href="{{ route('rental.rental_list') }}">Alquiler</a>
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
                <a href="{{ route('rental.rental_list') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    Regresar
                </a>
            </div>

            <div class="col-12">
                <hr />
            </div>
        </div>
        
        <form action="{{ route('rental.rentals_create_process') }}" method="POST" id="frmData" class="mt-2">
            <input type="hidden" name="formType" id="formType" value="rental-save">
            @include('pages.rental.components.forms.rental-client-films-form')

            <div class="row">
                <div class="col-12 mt-2" id="tableDataFilms"></div>

                <div class="col-12 mt-4">
                    <button class="btn btn-info btnAction" data-accion="rental-process-client" data-formulario="#frmData">
                        Alquilar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <input type="hidden" id="getData" value="{{ route('rental.film_view_added', ['ajax']) }}" data-target="#tableDataFilms" />
    <input type="hidden" id="viewLoading" value="{{ $view_load }}" />

@endsection

@section('page-styles')
    <link href="{{ URL::asset('content/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('content/vendor/simple-notify/dist/simple-notify.min.css') }}" rel="stylesheet" />
@endsection

@section('page-scripts')
    <script src="{{ URL::asset('content/common/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('content/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('content/vendor/simple-notify/dist/simple-notify.min.js') }}"></script>
@endsection