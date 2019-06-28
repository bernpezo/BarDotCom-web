$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
    /* Inicio Select2 comuna */
    $('#comuna').select2({
        ajax: {
            type: 'post',
            dataType: 'json',
            url: $('#comuna').data('url'),
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });
    var comunaSelect = $('#comuna');// selección preseleccionada
    $.ajax({
        type: 'GET',
        url: $('#comuna').data('url2')+'?id='+comuna
    }).then(function (data) {
        var option = new Option(data.nombre, data.id, true, true);
        comunaSelect.append(option).trigger('change');
        comunaSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
    /* Inicio Select2 rubro */
    $('#rubro').select2({
        allowClear: true,
        ajax: {
            type: 'post',
            dataType: 'json',
            url: $('#rubro').data('url'),
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });
    var rubroSelect = $('#rubro');// selección preseleccionada
    $.ajax({
        type: 'GET',
        url: $('#rubro').data('url2')+'?id='+rubro
    }).then(function (data) {
        var option = new Option(data.nombre, data.id, true, true);
        rubroSelect.append(option).trigger('change');
        rubroSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
    /* Inicio select2 local */
    $('#local').select2({
        allowClear: true,
        ajax: {
            type: 'post',
            dataType: 'json',
            url: $('#local').data('url'),
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });
    /* Fin Select2 */
    /* Mensaje respuesta */
    if(respuesta == 1){
        Swal.fire(
            'Realizado exitósamente',
            'La operación se ha realizado con éxito',
            'success'
        )
    }
    if(respuesta == 0){
        Swal.fire(
            'Error!',
            'Ha ocurrido un error. Contacte al adminstrador',
            'error'
        )
    }
});
