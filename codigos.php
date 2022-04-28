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
        <li class="breadcrumb-item active">Códigos de Cobranzas</li>
      </ol>
      <div class="row">
        <div class="col-12">


      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <div class="btn-group pull-right">
            <div>
              <button type="button" class="btn btn-info " data-toggle="modal" data-target="#Modal-alta-codigo" > 
                <span class="glyphicon glyphicon-plus"></span> Nuevo Código
              </button>    
            </div>
              <?php include('modal/Modal-alta-codigo.php'); ?>
              <?php include('modal/Modal-modif-codigo.php'); ?>

          </div>
          <i class="fa fa-table"></i> Códigos de Cobranzas
        </div>


        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm" id="dataTablecodigo" name="dataTablecodigo" width="100%" cellpadding="0" >
           <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->  
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Actividad</th>
                  <th>Categoría</th>
                  <th>Importe</th>
                  <th>Acción</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  require_once("conexion.php");


                  $sql="SELECT co.id_codigo,co.cod_precio,c.ca_nombre,a.ac_nombre, c.id_categoria,a.id_actividad FROM codigos as co
                  INNER JOIN categorias c ON  c.id_categoria=co.id_categoria
                  INNER JOIN actividades a ON a.id_actividad=co.id_actividad";


                  // $sql_cli="SELECT codigos.id_codigo,codigos.cod_periodo,codigos.id_actividad,codigos.id_categoria,codigos.cod_precio,categorias.ca_nombre FROM codigos INNER JOIN categorias WHERE codigos.id_categoria=categorias.id_categoria";
                  
                  $res_cli=mysqli_query($link,$sql);

                  while ($reg_cli=mysqli_fetch_array($res_cli))
                                {
                ?>

                  <tr class="odd gradeX">
 
                      <td><?php echo $reg_cli["id_codigo"];?></td>
                      <td><?php echo $reg_cli["ac_nombre"];?></td>
                      <td><?php echo $reg_cli["ca_nombre"];?></td>
                      <td style="text-align: right;">
                        <?php echo "$ ".number_format($reg_cli["cod_precio"], 2, ',', '.'); ?>
                        <!-- <?php echo $reg_cli["cod_precio"];?> -->
                         
                      </td>
                      <td style="text-align: center;">
                        
                       
                        <button type="button" class="btn btn-outline-dark btn-sm " data-toggle="modal" data-target="#Modal-modif-codigo" onclick="obtener_datos(<?php echo $reg_cli["id_codigo"] ;?>)"  > 
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>     

                   
                      </a>
               

                       
                      </td>

                      <input type="hidden" name="codigo" id="codigo_<?php echo $reg_cli["id_codigo"];?>" value="<?php echo $reg_cli["id_codigo"];?>"  >
                      <input type="hidden" name="importe" id="importe_<?php echo $reg_cli["id_codigo"];?>" value="<?php echo $reg_cli["cod_precio"];?>"  >
                      <input type="hidden" name="actividad" id="actividad_<?php echo $reg_cli["id_codigo"];?>" value="<?php echo $reg_cli["id_actividad"];?>"  >
                       <input type="hidden" name="categoria" id="categoria_<?php echo $reg_cli["id_codigo"];?>" value="<?php echo $reg_cli["id_categoria"];?>"  >
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
      <script type="text/javascript" src="js/codigo.js"></script> 






</body>

</html>
