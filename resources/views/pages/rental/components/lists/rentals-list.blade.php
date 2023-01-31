<div>
    <div class="row">
        <div class="col-12">
            @include('pages.rental.components.forms.rental-search-form')
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            Total de películas: {{ $rentals->total() }}
        </div>
    </div>

    <div id="dataDisplayPagination">
        <div class="row mt-4">
            @foreach($rentals as $rental)
                <div class="col-sm-6 col-md-4">

                    <div class="card card-custom bg-white border-white border-0 mt-3 mb-3" style="height: 450px">
                        <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"></div>
                        <div class="card-custom-avatar">
                            <img class="img-fluid" src="{{ URL::asset('app/images/general/user_icon_128.png') }}" alt="Avatar" />
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                            <h4 class="card-title text-ellipsis">{{ $rental->cliente_dato->cliente_dato_nombres . ' ' . $rental->cliente_dato->cliente_dato_apellidos }}</h4>
                            <p class="card-text">
                                <small class="text-muted">Identificación: {{ $rental->cliente_dato->cliente_dato_num_identificacion }}</small><br>
                                <small class="text-muted">Núm. películas rentadas: {{ count($rental->peliculas_datos_alquileres) }}</small><br>
                            </p>
                            <p class="card-text">{{ $rental->pelicula_dato_sinopsis }}</p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                            <div class="float-end">
                                <a href="{{ route('rental.rentals_edit', [$rental->id]) }}" class="btn btn-default">
                                    <i class="fa fa-solid fa-pencil"></i>
                                </a>

                                <button class="btn btn-link btnAction" data-accion="abrir-modal" data-route="{{ route('helpers.get_modal') }}" data-target="#rental-delete-modal" data-item-info="{{ Crypt::encrypt($rental->id) }}">
                                    <i class="fa-solid fa-trash color-red"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

            {!! $rentals->links('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
</div>