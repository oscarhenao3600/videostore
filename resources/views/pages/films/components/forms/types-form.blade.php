<div class="row">
    <div class="col-12">
        <div class="form-floating mb-2">
            <input type="text" class="form-control" name="pelicula_tipo_nombre" id="pelicula_tipo_nombre" placeholder="Ingrese el tipo de película" value="{{ old('pelicula_tipo_nombre', $film_type->pelicula_tipo_nombre) }}" autocomplete="off">
            <label for="pelicula_tipo_nombre">* Tipo de película</label>
            <span class="has-error pelicula_tipo_nombreError">&nbsp;</span>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12 col-md-6">
        <div class="form-floating mb-2">
            <input type="text" class="form-control" name="pelicula_tipo_dia_adicional_desde" id="pelicula_tipo_dia_adicional_desde" placeholder="Ingrese el número de días para cobro de adición" value="{{ old('pelicula_tipo_dia_adicional_desde', $film_type->pelicula_tipo_dia_adicional_desde) }}" autocomplete="off">
            <label for="pelicula_tipo_dia_adicional_desde">* Número de días para cobro de adición</label>
            <span class="has-error pelicula_tipo_dia_adicional_desdeError">&nbsp;</span>
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-floating mb-2">
            <input type="text" class="form-control" name="pelicula_tipo_porcent_dia_adicional" id="pelicula_tipo_porcent_dia_adicional" placeholder="Ingrese el porcentaje por día de adición" value="{{ old('pelicula_tipo_porcent_dia_adicional', $film_type->pelicula_tipo_porcent_dia_adicional) }}" autocomplete="off">
            <label for="pelicula_tipo_porcent_dia_adicional">* Porcentaje por día de adición</label>
            <span class="has-error pelicula_tipo_porcent_dia_adicionalError">&nbsp;</span>
        </div>
    </div>
</div>