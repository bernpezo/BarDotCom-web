$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
    /* Inicio DatePicker*/
    var date_input=$('input[name="fechaNacimiento"]');
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        language: 'es'
    };
    date_input.datepicker(options);
    /* Fin DatePicker*/
    /* Inicio Select2 */
    $('#comuna').select2({
        placeholder: 'Comuna',
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
    /* Fin Select2 */
    
});
