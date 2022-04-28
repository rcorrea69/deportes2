$(document).ready(function(){


		  foco();

		});

     function foco(){
      $('#op').focus();
    


    } 

	$("#dni").blur(function(){

 		var dni = $("#dni").val();


 		$.ajax({
 			type:"POST",
 			url:"ajax/busco_socio.php",
 			data:"dni="+dni,
 				success: function(datos){
 					$("#resultados_ajax").html(datos);
 
 				}
 			})

		});


$( "#frm-pagos" ).submit(function( event ) {
  // $('#guardar_datos').attr("disabled", true);
  var op=$('#op').val();

  if (op==""){
    alert('No Ingreso OP');
    return false;
  }

   //console.log(op);
   $.ajax({
      type: "POST",
      url: "ajax/busco_op.php",
      data: "op="+op,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        
        },
      success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#loader').html('');
      //$('#guardar_datos').hide;
      
      
      }
  });
  event.preventDefault();
});







   //   $("#dni").keypress(function(e) {
    

   //     if(e.which == 13) {
   //        // Acciones a realizar, por ej: enviar formulario.
   //  	//alert( "Le hice enter" );  

   //  		var dni= $("#dni").val();
		 // 	$.ajax({
			// type: "POST",
			// url: "ajax/busco_socio.php",
			// data: "dni="+dni,

			//  // beforeSend: function(objeto){
			// 	// $("#resultados_ajax2").html("Mensaje: Cargando...");
			//  //  },
			// success: function(datos){
			// $("#resultados_ajax").html(datos);
			// // $('#actualizar_datos').attr("disabled", false);
			// //e.preventDefault();	
		 //  		}
			// });



   //     }
   //  });	

  //    $("form").submit(function(e){

  //    e.preventDefault();

  //    //resto código   

	 // });


     function cargacombo(){

     		 $.ajax({
                            type: "POST",
                            url: "ajax/cbo-actividades.php",
                             success: function(response)
                             {
                                 $('#cbo').html(response);
                             }


      		});

     }



