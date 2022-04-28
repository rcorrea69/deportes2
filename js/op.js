$(document).ready(function(){

		detalle();
		buscosocio();
    buscoCategoria();
    foco();


          $('#datatableConsulta').DataTable({
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


		});

    function traigoCodigo(codigo){
      var codigo=codigo;
      $.ajax({
        type:"POST",
        url:"ajax/busco_codigo.php",
        data: {codigo:codigo},
        success: function(respuesta){
          var cod = JSON.parse(respuesta);
          var template="";
          //console.log(cod);
          if (cod!=""){ 
          
              cod.forEach(codigos=>{
              //console.log(codigos);
              template+=`
                <p> <strong>${codigos.actividad} ${codigos.categoria} ${codigos.importe} </strong></p>                         
              `
              })
            
            }
          else{



               template+=`
                    <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error! No Existe el codigo ingresado </strong> 
                    </div>`
                $('#codigo').focus();   

           } 

            $('#codNombre').html(template);



        }////fin del success

       

     });/////fin de ajax

    }
     
     $(document).on("click", ".btnElegir", function(){
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      //console.log(id);
      
      // nombre = fila.find('td:eq(1)').text();
      // pais = fila.find('td:eq(2)').text();
      // edad = parseInt(fila.find('td:eq(3)').text());
      
      // $("#nombre").val(nombre);
      // $("#pais").val(pais);
      // $("#edad").val(edad);
      // opcion = 2; //editar
      
      // $(".modal-header").css("background-color", "#007bff");
      // $(".modal-header").css("color", "white");
      // $(".modal-title").text("Editar Persona");            
      // $("#modalCRUD").modal("show");  
      
      $("#codigo").val(id);
      $("#modalCodigo").modal("hide"); 
      traigoCodigo(id);
      $("#periodo").focus();
  });


    function foco(){
      $('#codigo').focus();
    }
  
    function detalle(){
        var dni=$("#dni").val();  
          $.ajax({
                type: "POST",
                url: "ajax/op-tem-detalles.php",
                data:{dni},
                success: function(response)
                  {
                    $('#detalle_ajax').html(response);
                  }
          });
    };


$( "#frm-op" ).submit(function( event ) {
  var parametros = $(this).serialize();
  
  $.ajax({
      type: "POST",
      url: "ajax/tmp-op.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
          },
      success: function(datos){
        $("#resultados_ajax").html(datos);
        detalle();
        $('#frm-op').trigger('reset');
        $('#codigo').focus();
        $('#codNombre').html('<p></p>');
      }
  });
  event.preventDefault();
});


    function buscosocio(){
  
      var dni=$("#dni").val();
      
        $.ajax({
          type:"POST",
          url:"ajax/busco_socio.php",
          data: {dni:dni},
          success: function(respuesta){
            var socio = JSON.parse(respuesta);
            var template="";
              socio.forEach(socios=>{
                //console.log(socios);
                template+=`
                  <p>Socio: <strong>${socios.dni}  ${socios.nombre} ${socios.apellido}</strong></p>
                  <p>${socios.nombre} ${socios.apellido} </p> 
                  <p class="float-right">Apto Médico: ${socios.apto}  </p>               
                `
                })
              $('#socio').html(template);
          }
        });
    };    

    function buscoCategoria(){
    
      var dni=$("#dni").val();
      
        $.ajax({
          type:"POST",
          url:"ajax/busco_socio.php",
          data: {dni:dni},
          success: function(respuesta){
            var socio = JSON.parse(respuesta);
            var template="";
              socio.forEach(socios=>{
                //console.log(socios);
                template+=`
                  <p>Categoría:<strong> ${socios.categoria}</strong></p>
                `
                })
              $('#categoria').html(template);
          }
        });
    };

    $('#codigo').blur(function(){ 
      var codigo =$('#codigo').val();
        // console.log(codigo); 
        if (codigo==""){
          $('#frm-op').trigger('reset');

        }

        else {
          traigoCodigo(codigo);

      //    $.ajax({
      //     type:"POST",
      //     url:"ajax/busco_codigo.php",
      //     data: {codigo:codigo},
      //     success: function(respuesta){
      //       var cod = JSON.parse(respuesta);
      //       var template="";
      //       //console.log(cod);
      //       if (cod!=""){ 
            
      //           cod.forEach(codigos=>{
      //           //console.log(codigos);
      //           template+=`
      //            <p> <strong>${codigos.actividad} ${codigos.categoria} ${codigos.importe} </strong></p>                         
      //           `
      //           })
               
      //         }
      //        else{



      //            template+=`
      //                 <div class="alert alert-danger" role="alert">
      //                 <button type="button" class="close" data-dismiss="alert">&times;</button>
      //                 <strong>Error! No Existe el codigo ingresado </strong> 
      //                 </div>`
      //             $('#codigo').focus();   

      //        } 

      //         $('#codNombre').html(template);



      //     }////fin del success

         

      //  });/////fin de ajax

        }////fin del else 
    });



// Borro solo un item del detalle de pagos
$(document).on('click','.borro-item',function(){
  
  var elemento=$(this)[0].parentElement.parentElement;
  var id = $(elemento).attr('idcodigo');
    $.post('ajax/borro_item.php',{id},function(respuesta){
        detalle();
        //console.log(respuesta);

    })

});


