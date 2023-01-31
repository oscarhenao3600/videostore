<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Película</td>
                <td>Fecha de préstamos y entrega</td>
                <td>Número de días</td>
                <td>Costo renta</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr>
                    <td>
                        <strong>{{ $film->pelicula_dato_nombre }}</strong><br>
                        <small>Tipo: {{ $film->pelicula_tipo->pelicula_tipo_nombre }}</small><br>
                        <small>Precio unitario: ${{ num_format($film->pelicula_dato_precio_unitario) }}</small><br>
                        <small>Porcentaje días de adición: {{ $film->pelicula_dato_alquiler_dia_porcent_adicional }}%</small><br>
                        <small>Cobrar días de adición después de {{ $film->pelicula_dato_alquiler_dia_adicional_desde }} días</small>
                    </td>
                    <td>
                        <div class="width-200">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control selectDate" name="pelicula_dato_alquiler_fecha_inicio{{ $film->id }}" id="pelicula_dato_alquiler_fecha_inicio{{ $film->id }}" placeholder="Seleccione la fecha de préstamo. YYYY-MM-DD" value="{{ old('pelicula_dato_alquiler_fecha_inicio', $film->pelicula_dato_alquiler_fecha_inicio) }}" autocomplete="off">
                                <label for="pelicula_dato_alquiler_fecha_inicio{{ $film->id }}">* Fecha de préstamos</label>
                                <span class="has-error pelicula_dato_alquiler_fecha_inicio{{ $film->id }}Error">&nbsp;</span>
                            </div>
                        </div>

                        <div class="width-200">
                            <div class="form-floating">
                                <input type="text" class="form-control selectDate" name="pelicula_dato_alquiler_fecha_fin{{ $film->id }}" id="pelicula_dato_alquiler_fecha_fin{{ $film->id }}" placeholder="Seleccione la fecha de entrega. YYYY-MM-DD" value="{{ old('pelicula_dato_alquiler_fecha_fin', $film->pelicula_dato_alquiler_fecha_fin) }}" autocomplete="off">
                                <label for="pelicula_dato_alquiler_fecha_fin{{ $film->id }}">* Fecha de entrega</label>
                                <span class="has-error pelicula_dato_alquiler_fecha_fin{{ $film->id }}Error">&nbsp;</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $film->pelicula_dato_alquiler_num_dias }} días
                    </td>
                    <td>
                        ${{ num_format($film->pelicula_dato_alquiler_valor_sub_total) }}
                    </td>
                    <td>
                        <button class="btn btn-link btnAction" data-accion="rental-update-film" data-route="{{ route('rental.film_change_dates') }} " data-pelicula-dato="{{ $film->id }}" data-target="#tableDataFilms">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>

                        <br>

                        <button class="btn btn-link btnAction" data-accion="rental-action-table-film" data-route="{{ route('rental.film_remove') }} " data-pelicula-dato="{{ $film->id }}" data-target="#tableDataFilms">
                            <i class="fa fa-solid fa-trash color-red"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <div class="float-end">
                        <h3><strong>Subtotal</strong>: ${{ num_format($total_pay) }}</h3>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>