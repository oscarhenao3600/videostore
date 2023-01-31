<div class="row">
    <div class="col-12 mt-2">
        <legend>Datos del cliente y película</legend>
        <p>Ingrese el número de identificación del cliente y luego hacer click en el botón buscar.</p>
    </div>

    <div class="col-md-6 offset-md-3 mt-2">
        <p>Por favor seleccione un cliente.</p>

        <div class="form-floating mb-1">
            <input type="text" class="form-control" name="cliente_dato_num_identificacion" id="cliente_dato_num_identificacion" list="dataListClients" placeholder="Ingrese el número de identificación" value="{{ old('cliente_dato_num_identificacion', $cliente_dato->cliente_dato_num_identificacion) }}" autocomplete="off">
            <label for="cliente_dato_num_identificacion">* Número identificación</label>
            <span class="has-error cliente_dato_num_identificacionError">&nbsp;</span>
        </div>
        <hr />
    </div>

    <div class="col-md-6 offset-md-3 mt-2">
        <p>Puede seleccionar mínimo uno o varias peliculas.</p>

        <div class="form-floating mb-1">
            <input type="text" class="form-control" name="pelicula_dato_nombre" id="pelicula_dato_nombre" list="dataListFilms" placeholder="Ingrese el nombre de la película" value="{{ old('cliente_dato_num_identificacion', $cliente_dato->cliente_dato_num_identificacion) }}" autocomplete="off">
            <label for="pelicula_dato_nombre">* Película</label>
            <span class="has-error pelicula_datoError">&nbsp;</span>
        </div>
        <button class="btn btn-primary width-full btnAction" data-accion="rental-add-film" data-route="{{ route('rental.film_add') }}" data-target="#tableDataFilms">Seleccionar</button>

        <hr />
    </div>

    <datalist id="dataListClients">
        @foreach($clientes_datos as $cliente_dato)
            <option label="{{ $cliente_dato->cliente_dato_nombres . ' ' . $cliente_dato->cliente_dato_apellidos }}" value="{{ $cliente_dato->cliente_dato_num_identificacion }}">
        @endforeach
    </datalist>

    <datalist id="dataListFilms">
        @foreach($films_data as $film_data)
            <option value="{{ $film_data->id . ' - ' . $film_data->pelicula_dato_nombre }}">
        @endforeach
    </datalist>
</div>