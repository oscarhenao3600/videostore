@extends('vendor.template.master')

@section('page-title', 'Alquilar')

@section('page-content-breadcrumb')
    <div class="mb-1">
        <nav aria-label="breadcrumb">
            <ul class="breadcrumbs">
                <li class="first">
                    <a href="{{ route('home.index') }}">
                        <i class="fa fa-solid fa-house"></i>
                    </a>
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
                <a href="{{ route('rental.rentals_create') }}" class="btn btn-outline-primary float-end">
                    Nuevo alquiler
                </a>
            </div>

            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 mt-5">
                <div id="dataDisplay"></div>
            </div>
        </div>
    </div>

    <div id="modalData"></div>

    <input type="hidden" id="getData" value="{{ route('rental.get_rentals') }}" data-target="#dataDisplay" />
    <input type="hidden" id="viewLoading" value="{{ $view_load }}" />

@endsection