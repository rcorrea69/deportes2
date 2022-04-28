$(document).ready(function(){

  cargacboano();
  foco();
  

		});

function foco(){
  $('#dni').focus();
} 

    function cargacboano(){
      $.ajax({
        type: "POST",
        url: "ajax/cbo-ano.php",
        success: function(response)
        {
          $('#cbo_ano').html(response);
          consulta();
        }
      });
    }


  function consulta(){
    var dni=$('#dni').val();
    var ano=$('#ano').val();

    $.ajax({
      type: "POST",
      url: "ajax/consulta-pagos.php",
      data: {dni:dni,ano:ano},
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

  }




