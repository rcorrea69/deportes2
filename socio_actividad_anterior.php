<?php require 'include\validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">


<head>

 <?php include('include\header.php') ?>



</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php include('include\menu.php') ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Principal</a>
        </li>
        <li class="breadcrumb-item active">Asignación de Actividades</li>
      </ol>
      <div class="row">
        <div class="col-12">


        <div class="card">
          <form id="frmsocio_actividad">
          <div class="card-body">

                <div class="form-row">
  
                  <div class="form-group col-md-3"><!-- 
                      <label for="dni">Nro de Socio</label> -->
                      <input type="text" class="form-control" id="dni" name="dni" placeholder="D.N.I.">
                      
                                  
                  </div>
  
                  <div class="form-group col-md-6">
                      <!-- <label for="cbo">Actividades</label> -->
                      <div id="cbo" name="cbo"> </div>
                  </div>
                  <div class="form-group col-md-3">
                     <button type="submit" class="btn btn-primary" id="guardar" name="guardar">Agregar Actividad</button>
                  </div>
                    
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div> 
                   
    
                </div>
          
          </div>            
                 <!--  <div  class="row" id="resultados_ajax"></div> -->
          </form>


        </div>


        <div  id="resultados_ajax"></div>



        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Ruben Correa Website 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Logout Modal-->
      <?php include('modal\cerrar_sesion.php') ?>
    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
      <?php include('include\librerias_js.php') ?>  
  </div>
   <script type="text/javascript" src="js/socio_actividad.js"></script> 

    <script type="text/javascript"> 

        $(function() {
            $("#cliente").autocomplete({
                source: "autocomplete_cliente.php",
                minLength: 2,
                select: function(event, ui) {
                    event.preventDefault();
                    //event.defaultPrevented ();
                    $('#cliente').val(ui.item.ac_nombre);
                    //$('#descripcion').val(ui.item.ofi_nombre);
                    $('#id_cliente').val(ui.item.id);
                    //$('#id_iva').val(ui.item.iva);

                  
                 }
            });
        });
    </script>     

</body>



</html>
