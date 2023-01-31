<div class="row">
    <div class="col-12">
        <div class="form-floating mb-2">
            <input type="text" class="form-control" name="pelicula_genero_nombre" id="pelicula_genero_nombre" placeholder="Ingrese el género de película" value="{{ old('pelicula_genero_nombre', $film_gender->pelicula_genero_nombre) }}" autocomplete="off">
            <label for="pelicula_genero_nombre">* Género</label>
            <span class="has-error pelicula_genero_nombreError">&nbsp;</span>
        </div>
    </div>
</div>