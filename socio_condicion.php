<?php require 'include/validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('include/header.php') ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php include('include/menu.php') ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="panel_socios.php">Principal</a>
        </li>
        <li class="breadcrumb-item active">Condición de Socio</li>
      </ol>
      <div class="row">
        <div class="col-12">


      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <div class="btn-group pull-right">
            <div>
              <button type="button" class="btn btn-info " data-toggle="modal" data-target="#Modal-alta-condicion" > 
                <span class="glyphicon glyphicon-plus"></span> Nueva Condición de Socio
              </button>    
            </div>
              <?php include('modal/Modal-alta-condicion.php'); ?>
            

          </div>
          <i class="fa fa-table"></i> Categorías de Socios
        </div>


        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm" id="dataCondicion" name="dataCondicion" width="100%" cellpadding="0" >
           <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->  
              <thead>
                <tr>
                
                  <th>Id Condición</th>
                  <th>Condición Descripción</th>

                </tr>
              </thead>

              <tbody>
                <?php
                  require_once("conexion.php");
                
                    $sql="SELECT * FROM condicion";
               
                  $res_cli=mysqli_query($link,$sql);

                  while ($reg_cli=mysqli_fetch_array($res_cli))
                                {
                ?>

                  <tr class="odd gradeX">
 
                      <td><?php echo $reg_cli["id_condicion"];?></td>
                      <td><?php echo $reg_cli["con_nombre"];?></td>
                    
                  </tr>

                <?php
                                }
                ?>

              </tbody>
            </table>
          </div>
          </div>
          <div class="card-footer small text-muted">
          </div>
      </div> <!-- card -->



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
    


  </div>


    <!-- Logout Modal-->
      <?php include('modal/cerrar_sesion.php') ?>
    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->

      <?php include('include/librerias_js.php') ?> 
      <script type="text/javascript" src="js/socio_condicion.js"></script> 






</body>

</html>
