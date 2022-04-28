<?php require 'include/validar_session.php';?>

<!DOCTYPE html>
<html lang="es">

<head>


   <?php include 'include/header.php'?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php include 'include/menu.php'?>

  <div class="content-wrapper">
    <div class="container">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="panel_socios.php">Principal</a>
        </li>
        <li class="breadcrumb-item active">Alta de Socio</li>
      </ol>
 
      <div class="row">
        <div class="col-md-6 offset-3">
        <div class="card border-primary">
              <div class="card-header  bg-secondary text-white">
                <h5 class="text-white">Ficha de Alta de Socio <strong class="text-success"> Foto Paso 2/2 </strong></h5>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-12"> 
                    <div id="resultados_ajax"></div>
                    <div id="uploadForm">
                      <!-- <img src="uploads/vacio.jpg" class="card-img-top" alt="..." > -->
                    </div>
                      <input type="hidden" id="dni" value="22805302" >
                      <h3 class="card-title mb-0">Socio: 22805302</h3>
                      <h5><p class="card-text ">Ruben Antonio Correa del valle</p></h5>
                      
                    <form method="post" action="upload.php" enctype="multipart/form-data" id="frm_foto_socio" >
                      <input type="file" name="file" id="file" class="form-control btn btn-primary" accept=".jpg" required />

                  </div> <!-- columna 12 -->

              
                </div><!--  row -->
              </div> <!-- card body -->
              <div class="card-footer">
                <input type="submit" name="submit" value="Upload"  class="btn btn-primary"/>
                <!-- <input type="file" name="file" id="file" class="form-control btn btn-primary" required /> -->
              </div>
              </form>
          </div><!--  card -->
        </div><!-- /.col-6-->
      </div><!-- /.row-->
      
    </div> <!-- /.container-->
    
    
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
      <?php include 'modal/cerrar_sesion.php'?>
    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
      <?php include 'include/librerias_js.php'?>
      <script src="js/upload.js"></script>  
  </div><!-- /.content-wrapper-->
      </body>

</html>
