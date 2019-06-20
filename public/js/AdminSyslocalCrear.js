$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
    /* Inicio Select2 comuna */
    $('#comuna').select2({
        allowClear: true,
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
    /* Fin Select2 */
    
});
