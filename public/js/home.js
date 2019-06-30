$(document).ready(function() {
    /*
     * Formulario contacto
     */
    $('#contacto').click(function(event){
        event.preventDefault();
        if($('#email').val().length==0 || $('#nombre').val().length==0 || $('#asunto').val().length==0 || $('#mensaje').val().length==0){
            Swal.fire(
                '¡Falta información!',
                'Para poder contactarte debes completar todos los campos',
                'error'
            )
        }else{
            $('#email').val('');
            $('#nombre').val('');
            $('#asunto').val('');
            $('#mensaje').val('');
    	    Swal.fire(
                '¡Mensaje enviado!',
                'Nuestro equipo lo contactará via email',
                'success'
            )
        }
    });
});