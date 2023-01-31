$(document).ready(function() {
    filmGetData();
    dataPicker();
});

$(document).on('click', '.btnAction', function(e) {
    e.preventDefault();
    var btn = $(this);
    var opcion = btn.data('accion');
    var formulario;
    btn.attr('disabled', true);

    switch(opcion)
    {
        case 'abrir-modal':
            abrirModal(btn);
        break;

        case 'pelicula-dato':
            filmSendData(btn);
        break;

        case 'clients':
            clientsUpload(btn);
        break;

        case 'pelicula-tipo-genero':
            filmTypeGenereSendData(btn);
        break;

        case 'rental-add-film':
            rentalFilmAdd(btn);
        break;

        case 'rental-update-film':
        case 'rental-action-table-film':
            rentalFilmActionsTable(btn);
        break;

        case 'rental-process-client':
            rentalFilmClientProcess(btn);
        break;
    }
});

$(document).on('click', '.btnCloseModal', function(e) {
    e.preventDefault();
    $( $(this).data('modal') ).modal('hide');
});

$(document).on('click', '.btnCloseModal', function(e) {
    e.preventDefault();
    $( $(this).data('modal') ).modal('hide');
});

$(document).on('click', '.page-link', function(e){
    e.preventDefault();
    let route = $(this).attr('href');
    let page = $(this).attr('href').split('page=')[1];
    fetch_data(route, page);
});

function fetch_data(route, page)
{
    $.ajax({
        url: route,
        method: "GET",
        data: {page:page},
        success: function(data)
        {
            $('#dataDisplayPagination').html(data.view);
        }
    });
}

function filmGetData() {
    let routeLoadData = $('#getData');

    if(routeLoadData.length > 0) {
        $( $(routeLoadData).data('target') ).html( $('#viewLoading').val() );

        $.ajax({
            url: routeLoadData.val(),
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if(data.status == 'ok') {
                    $($(routeLoadData).data('target') + ' div').remove();
                    $($(routeLoadData).data('target')).html(data.view);

                    dataPicker();
                }
            },
            error: function(xhr, status, response) {
            }
        });
    }
}

function filmSendData(btn) {
    let modal = $( btn.data('modal') );
    let form = $( btn.data('formulario') );
    let route = form.attr('action');
    let method = form.attr('method');
    let chkFilmGender = new Array();

    $("input[name='chkFilmGender[]']:checked").each(function () {
        chkFilmGender.push($(this).val());
    });

    $.ajax({
        url: route,
        type: method,
        dataType: 'JSON',
        data: {
            formType: $('#formType').val(),
            pelicula_dato_nombre: $('#pelicula_dato_nombre').val(),
            pelicula_dato_fecha_estreno: $('#pelicula_dato_fecha_estreno').val(),
            pelicula_dato_precio_unitario: $('#pelicula_dato_precio_unitario').val(),
            pelicula_tipo_id: $('#pelicula_tipo_id').val(),
            pelicula_dato_sinopsis: $('#pelicula_dato_sinopsis').val(),
            peliculas_generos_datos: chkFilmGender,
        },
        success: function(data) {
            if(data.status == 'ok')
            {
                window.location.href = data.route;
            }
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            $('.pelicula_dato_nombreError').html('&nbsp;');
            $('.pelicula_dato_fecha_estrenoError').html('&nbsp;');
            $('.pelicula_dato_precio_unitarioError').html('&nbsp;');
            $('.pelicula_tipo_idError').html('&nbsp;');
            $('.pelicula_dato_sinopsisError').html('&nbsp;');
            $('.peliculas_generos_datosError').html('&nbsp;');

            var jsonData = xhr.responseJSON;

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function filmTypeGenereSendData(btn) {
    let modal = $( btn.data('modal') );
    let form = $( btn.data('formulario') );
    let route = form.attr('action');
    let method = form.attr('method');

    $.ajax({
        url: route,
        type: method,
        dataType: 'JSON',
        data: form.serialize(),
        success: function(data) {
            if(data.status == 'ok')
            {
                btn.attr('disabled', false);
                modal.modal('hide');
                filmGetData();
                toast(data.title, data.message, data.message_status);
            }
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            $('.pelicula_tipo_nombreError').html('&nbsp;');
            $('.pelicula_tipo_dia_adicional_desdeError').html('&nbsp;');
            $('.pelicula_tipo_porcent_dia_adicionalError').html('&nbsp;');
            $('.pelicula_genero_nombreError').html('&nbsp;');

            var jsonData = xhr.responseJSON;

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function clientsUpload(btn) {
    let modal = $( btn.data('modal') );
    let form = $( btn.data('formulario') );
    let route = form.attr('action');
    let method = form.attr('method');

    var formData = new FormData(form[0]);
    formData.append('formFileUploadClients', ($("#formFileUploadClients"))[0].files[0]);

    $.ajax({
        url: route,
        type: method,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        data: formData,
        success: function(data) {
            if(data.status == 'ok')
            {
                btn.attr('disabled', false);
                modal.modal('hide');
                filmGetData();
                toast(data.title, data.message, data.message_status);
            }
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            $('.pelicula_tipo_nombreError').html('&nbsp;');

            var jsonData = xhr.responseJSON;

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function rentalFilmAdd(btn) {
    let route = btn.data('route');
    let method = 'POST';

    $.ajax({
        url: route,
        type: method,
        dataType: 'JSON',
        data: {
            formType: btn.data('accion'),
            pelicula_dato: $('#pelicula_dato_nombre').val()
        },
        success: function(data) {
            $('.pelicula_datoError').html('&nbsp;');

            if(data.status == 'ok')
            {
                $('#pelicula_dato_nombre').val('');
                $(btn.data('target') + ' div').remove();
                $(btn.data('target')).html(data.view);

                dataPicker();
            }

            toast(data.title, data.message, data.message_status);
            btn.attr('disabled', false);
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            $('.pelicula_datoError').html('&nbsp;');

            var jsonData = xhr.responseJSON;
            console.log(jsonData);

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function rentalFilmActionsTable(btn) {
    let route = btn.data('route');
    let method = 'POST';
    let peliculaDato = btn.data('pelicula-dato');

    $.ajax({
        url: route,
        type: method,
        dataType: 'JSON',
        data: {
            pelicula_dato_alquiler_fecha_inicio: $('#pelicula_dato_alquiler_fecha_inicio' + peliculaDato).val(),
            pelicula_dato_alquiler_fecha_fin: $('#pelicula_dato_alquiler_fecha_fin' + peliculaDato).val(),
            formType: btn.data('accion'),
            pelicula_dato: peliculaDato
        },
        success: function(data) {
            $('.pelicula_dato_alquiler_fecha_inicio' + peliculaDato + 'Error').html('&nbsp;');
            $('.pelicula_dato_alquiler_fecha_fin' + peliculaDato + 'Error').html('&nbsp;');

            if(data.status == 'ok')
            {
                $(btn.data('target') + ' div').remove();
                $(btn.data('target')).html(data.view);

                dataPicker();
            }

            toast(data.title, data.message, data.message_status);
            btn.attr('disabled', false);
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            $('.pelicula_dato_alquiler_fecha_inicio' + peliculaDato + 'Error').html('&nbsp;');
            $('.pelicula_dato_alquiler_fecha_fin' + peliculaDato + 'Error').html('&nbsp;');

            var jsonData = xhr.responseJSON;

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + peliculaDato + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function rentalFilmClientProcess(btn) {
    let modal = $( btn.data('modal') );
    let form = $( btn.data('formulario') );
    let route = form.attr('action');
    let method = form.attr('method');

    $.ajax({
        url: route,
        type: method,
        dataType: 'JSON',
        data: form.serialize(),
        success: function(data) {
            btn.attr('disabled', false);

            if(data.status == 'ok') {
                window.location.href = data.route;
            } else if(data.status == 'error') {
                toast(data.title, data.message, data.message_status)
            }
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);

            var jsonData = xhr.responseJSON;

            if(jsonData !== undefined) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    if(key != '')
                    {
                        $('.' + key + peliculaDato + 'Error').html(value);
                    }
                });
            }
        }
    });
}

function abrirModal(btn) {
    $.ajax({
        url: btn.data('route'),
        type: 'POST',
        dataType: 'JSON',
        data: {
            target: btn.data('target'),
            item_info: btn.data('item-info')
        },
        success: function(response) {
            if(response.status == 'ok')
            {
                btn.attr('disabled', false);
                $('#modalData').html(response.modal_web);
                $( response.modal_id ).modal('show');
            }
        },
        error: function(xhr, status, response) {
            btn.attr('disabled', false);
        }
    });
}

function dataPicker() {
    let dataPicker = $('.selectDate');

    if(dataPicker.length > 0) {
        dataPicker.daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    }
}

function toast(titleToast, messageToast, statusToast) {
    new Notify ({
        title: titleToast,
        text: messageToast,
        effect: 'slide',
        speed: 300,
        status: statusToast,
        autoclose: true,
    })
}