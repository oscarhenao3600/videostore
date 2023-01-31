<div>
    <div class="row">
        <div class="col-12">
            @include('pages.films.components.forms.films-search-form')
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            Total de películas: {{ $films->total() }}
        </div>
    </div>

    <div id="dataDisplayPagination">
        <div class="row mt-4">
            @foreach($films as $film)
                <div class="col-sm-6 col-md-4">

                    <div class="card card-custom bg-white border-white border-0 mt-3 mb-3" style="height: 450px">
                        <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"></div>
                        <div class="card-body" style="overflow-y: auto">
                            <h4 class="card-title text-ellipsis">{{ $film->pelicula_dato_nombre }}</h4>
                            <p class="card-text">
                                <small class="text-muted">Precio unitario: ${{ num_format($film->pelicula_dato_precio_unitario) }}</small><br>
                                <small class="text-muted">Fecha de lanzamiento: {{ $film->pelicula_dato_fecha_estreno->format('d') . ' de ' . mounth($film->pelicula_dato_fecha_estreno->format('m')) . ', ' . $film->pelicula_dato_fecha_estreno->format('Y') }}</small>
                            </p>
                            <p class="card-text">{{ $film->pelicula_dato_sinopsis }}</p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                            <div class="float-end">
                                <a href="{{ route('films.films_edit', [$film->id]) }}" class="btn btn-default">
                                    <i class="fa fa-solid fa-pencil"></i>
                                </a>

                                <button class="btn btn-link btnAction" data-accion="abrir-modal" data-route="{{ route('helpers.get_modal') }}" data-target="#films-delete-modal" data-item-info="{{ Crypt::encrypt($film->id) }}">
                                    <i class="fa-solid fa-trash color-red"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

            {!! $films->links('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
</div>