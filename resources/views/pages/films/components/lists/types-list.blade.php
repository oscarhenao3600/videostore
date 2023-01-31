<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Tipo</td>
                <td>Cobrar adicional</td>
                <td>Porcentajes días adicional</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->pelicula_tipo_nombre }}</td>
                    <td>{{ $type->pelicula_tipo_dia_adicional_desde . ' días después' }}</td>
                    <td>{{ $type->pelicula_tipo_porcent_dia_adicional . '%' }}</td>
                    <td>
                        <div class="d-grid gap-2 d-md-flex">
                            <button class="btn btn-link btnAction" data-accion="abrir-modal" data-route="{{ route('helpers.get_modal') }}" data-target="#films-type-edit-modal" data-item-info="{{ Crypt::encrypt($type->id) }}">
                                <i class="fa fa-solid fa-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>