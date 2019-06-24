$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
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