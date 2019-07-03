$(document).ready(function() {
    /* Mensaje respuesta */
    if(respuesta == 2){
        Swal.fire(
            '¡No puedes pedir este producto!',
            'No tienes un ingreso registrado en este local. Si ya pagaste tu cuenta, vuelve a registrarte',
            'info'
        )
    }
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