		$(document).ready(function(){
			
		});



		function refrescar_tabla(){

		setTimeout('location.reload()',1500);	
		location.reload();
			
		}

   $("#cierre").click(function(event) {
   		
	   	$("#guardar_condicion")[0].reset();
   });		
	
$( "#guardar_condicion" ).submit(function( event ) {
  $('#guardar_condicion').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_condicion.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
				
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').hide;
			refrescar_tabla();
			
		  }
	});
  event.preventDefault();
})


        $('#dataTablecodigo').DataTable({
            language:{
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
            responsive: true
        }); 
		
		

