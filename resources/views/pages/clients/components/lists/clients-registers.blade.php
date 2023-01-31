<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Número de identificación</td>
                <td>Nombre(s)</td>
                <td>Apellidos(s)</td>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->cliente_dato_num_identificacion }}</td>
                    <td>{{ $client->cliente_dato_nombres }}</td>
                    <td>{{ $client->cliente_dato_apellidos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>