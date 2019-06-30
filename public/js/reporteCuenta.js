$(document).ready( function () {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
    /*
     * Data table pedidos entregados
     */
    var tablaCuentas=$('#tablaReporteCuenta').DataTable({
		"searching": false,
		//idioma de datatable
		"bProcessing": false,
		"serverSide": true,
		"width" : "100%",
		"language": {
		    	"sProcessing":     "Procesando...",
		        "sLengthMenu":     "Mostrar _MENU_ registros",
		        "sZeroRecords":    "No se encontraron resultados",
		        "sEmptyTable":     "Ningún dato disponible en esta tabla",
		        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		        "sInfoPostFix":    "",
		        "sSearch":         "Buscar:",
		        "sUrl":            "",
		        "sInfoThousands":  ",",
		        "sLoadingRecords": "Cargando...",
		        "oPaginate": {
		            "sFirst":    "Primero",
		            "sLast":     "Último",
		            "sNext":     "Siguiente",
		            "sPrevious": "Anterior"
		        },
		        "oAria": {
		            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		        }
        },
        //configuracion de la peticion ajax
		"ajax":{
            url: $('#tablaReporteCuenta').data('url'),
			type: 'post',
			error: function(error){
				//en caso de error
				Swal.fire(
                    'Error!',
                    'Ha ocurrido un error. Contacte al adminstrador',
                    'error'
                )
			}
		},
		//columnas que llenaran la tabla
		"columns": [
			{ "data": "id"},
			{ "data": "idCliente"},
			{ "data": "idUsuario"},
			{ "data": "idMesa"},
            { "data": "total"},
            { "data": "fecha"},
		],
		//exportar a pdf
		dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
				pageSize: 'LETTER',
				customize: function(doc) {
					//márgenes [left, top, right, bottom] 
					doc.pageMargins = [ 150, 20, 150, 20 ];
				}
            }
        ]
	});
} );