$(document).ready(function() {
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
});
