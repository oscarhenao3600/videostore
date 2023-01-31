<div class="row">
    <div class="col-12 mt-2">
        <legend>Datos de la película</legend>
        <p>Ingrese los datos de la película. Los campos con * son obligatorios</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="pelicula_dato_nombre" id="pelicula_dato_nombre" placeholder="Ingrese el nombre de película" value="{{ old('pelicula_dato_nombre', $film_data->pelicula_dato_nombre) }}" autocomplete="off">
            <label for="pelicula_dato_nombre">* Nombre de película</label>
            <span class="has-error pelicula_dato_nombreError">&nbsp;</span>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control selectDate" name="pelicula_dato_fecha_estreno" id="pelicula_dato_fecha_estreno" placeholder="Seleccione la fecha de estreno. YYYY-MM-DD" value="{{ old('pelicula_dato_fecha_estreno', $film_data->pelicula_dato_fecha_estreno) }}" autocomplete="off">
            <label for="pelicula_dato_fecha_estreno">* Fecha de estreno</label>
            <span class="has-error pelicula_dato_fecha_estrenoError">&nbsp;</span>
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="pelicula_dato_precio_unitario" id="pelicula_dato_precio_unitario" placeholder="Ingrese el precio unitario" value="{{ old('pelicula_tipo_porcent_dia_adicional', $film_data->pelicula_dato_precio_unitario) }}" autocomplete="off">
            <label for="pelicula_dato_precio_unitario">* Precio unitario</label>
            <span class="has-error pelicula_dato_precio_unitarioError">&nbsp;</span>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12 col-md-6">
        <div class="form-floating">
            <select class="form-select" id="pelicula_tipo_id" name="pelicula_tipo_id" aria-label="Floating label select">
                <option value="-1">Seleccione un tipo</option>
                @foreach($film_types as $film_type)
                    <option value="{{ $film_type->id }}" @if($film_data) {{ $film_data->pelicula_tipo_id == $film_type->id ? 'selected' : '' }} @endif>{{ $film_type->pelicula_tipo_nombre }}</option>
                @endforeach
            </select>
            <label for="pelicula_tipo_id">Seleccione un tipo</label>
            <span class="has-error pelicula_tipo_idError">&nbsp;</span>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Ingrese la sinopsis" id="pelicula_dato_sinopsis" name="pelicula_dato_sinopsis" style="height: 100px" autocomplete="off">{{ old('pelicula_dato_sinopsis', $film_data->pelicula_dato_sinopsis) }}</textarea>
            <label for="pelicula_dato_sinopsis">* Tipo de película</label>
            <span class="has-error pelicula_dato_sinopsisError">&nbsp;</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mt-4">
        <legend>Géneros de la película</legend>
        <p>Seleccione los géneros a los que pertenece la película. Seleccione por lo menos 1 género.</p>
    </div>
</div>

<div class="row mt-2">
    <span class="has-error peliculas_generos_datosError"></span>
    @foreach($film_genders as $film_gender)
        <div class="col-sm-12 col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" name="chkFilmGender[]" type="checkbox" id="flexSwitchCheckChecked{{ $film_gender->id }}" class="chkFilmGender" value="{{ $film_gender->id }}" @if(count($film_data->peliculas_generos_datos) > 0) {{ find_by_data($film_data->peliculas_generos_datos, 'pelicula_genero_id', $film_gender->id) ? 'checked' : '' }} @endif>
                <label class="form-check-label" for="flexSwitchCheckChecked{{ $film_gender->id }}">{{ $film_gender->pelicula_genero_nombre }}</label>
            </div>
        </div>
    @endforeach
</div>