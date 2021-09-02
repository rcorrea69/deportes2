		$(document).ready(function(){
			
			$('#nombres').focus();
		});



		function refrescar_tabla(){

		setTimeout('location.reload()',1500);	
		//location.reload();
			
		}

	
		
		
   $("#cierre").click(function(event) {
   		
	   	$("#guardar_usuario")[0].reset();
   });		
	
$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_usuario.php",
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

$( "#modif_usuario" ).submit(function( event ) {
 // $('#guardar_datos').attr("disabled", true);


  
 var parametros = $(this).serialize();
 //console.log(parametros);
	 $.ajax({
			type: "POST",
			url: "ajax/modif_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_modif").html("Mensaje: Cargando...");
				
			  },
			success: function(datos){
			$("#resultados_ajax_modif").html(datos);
			$('#guardar_datos').hide;
			refrescar_tabla();
			
		  }
	});
  event.preventDefault();
})


			function obtener_datos(id){
			var usuario=id;
			var nombre=$("#nombre_"+id).val();
			var usu=$("#usu_"+id).val();
			var clave=$("#clave_"+id).val();
			var nivel=$("#nivel_"+id).val();

			$("#usuario-modif").val(usuario);
			$("#nombre-modif").val(nombre);
			$('#usu-modif').val(usu);
			$('#clave-modif').val(clave);
			$('#nivel-modif').val(nivel);

		}


    $('#nombres').on('keyup', function (e) {
    var txt = $(this).val();
    $(this).val(txt.replace(/^(.)|\s(.)/g, function ($1) {
      return $1.toUpperCase( );
    }));
  });



		
		

