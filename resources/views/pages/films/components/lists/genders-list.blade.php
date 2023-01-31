<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Generó</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($genders as $gender)
                <tr>
                    <td>{{ $gender->pelicula_genero_nombre }}</td>
                    <td>
                        <div class="d-grid gap-2 d-md-flex">
                            <button class="btn btn-link btnAction" data-accion="abrir-modal" data-route="{{ route('helpers.get_modal') }}" data-target="#films-gender-edit-modal" data-item-info="{{ Crypt::encrypt($gender->id) }}">
                                <i class="fa fa-solid fa-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>