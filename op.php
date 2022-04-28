<?php require 'include/validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

  <?php include('include/header.php'); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include('include/menu.php') ?>
  <?php

  $dni = $_GET["dni"];
  //require_once('conexion.php');
  include('include/hoy.php');
  $ano = intval(substr($hoy, 6, 4));
  //include('include/funciones.php');

  ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="panel_socios.php">Principal</a>
        </li>
        <li class="breadcrumb-item active">Generar Oden de Pago</li>
      </ol>

      <!-- agregando foto -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <h5>
              <div id="socio" class="mb-0"></div>
              <div id="categoria"></div>
            </h5>

          </div>
          <div class="col-4">
            <div>
              <img src="fotos/22805302.jpg" class="img-fluid rounded mx-auto d-block float-rigth" alt="..." width="250px">
            </div>
          </div>

        </div>

      </div>

      <!-- fin de foto -->
      <div class="row">
        <!-- cabecera datos personates del socio -->
        <!-- <div class="col-12">
          <h5>
            <div id="socio" class="float-left"></div>

            <div id="categoria" class="float-right"></div>
          </h5>
        </div> -->

        <!-- <div class="col-5">
          <h5><div id="categoria" class=""></div></h5>
        </div> -->
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <!-- Consulta de actividades y pagos anteriores -->
          <div class="card">
            <div class="card-body">

              <p class="mb-0" class="justify-content-center align-items-center">
                <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Actividades
                </button>
                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapsePagos" aria-expanded="false" aria-controls="collapsePagos">
                  Historial de Pagos
                </button>
                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseOp" aria-expanded="false" aria-controls="collapseOp">
                  Orden de Pagos
                </button>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card border-success card-body">

                  <?php

                  global $link;

                  $sql_Act = "SELECT so.id_socio,so.id_actividad,so.fecha_alta,ac.id_actividad,ac.ac_nombre 
                  FROM socio_actividad so
                  INNER JOIN actividades ac ON so.id_actividad=ac.id_actividad
                  WHERE id_socio=$dni AND ano=$ano ";

                  $res_Act = mysqli_query($link, $sql_Act);
                  $cantidadFila = mysqli_num_rows($res_Act);
                  if ($cantidadFila == 0) {
                  ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>El socio : <?php echo $dni; ?></strong> No Esta inscripto a ninguna actividad para este año .
                    </div>
                  <?php
                  } else {
                  ?>
                    <table class="table table-sm">


                      <thead class="table-success">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombre de la actividad</th>
                          <th scope="col">Fecha de Alta</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <?php
                          while ($reg_Act = mysqli_fetch_array($res_Act)) {
                          ?>

                            <th scope="row"><?php echo $reg_Act["id_actividad"]; ?></th>
                            <td><?php echo $reg_Act["ac_nombre"]; ?></td>
                            <td><?php echo formato_fecha_dd_mm_Y($reg_Act["fecha_alta"]); ?></td>

                        </tr>
                      <?php
                          }
                      ?>

                      </tbody>
                    </table>
                  <?php

                  }


                  ?>



                </div>
              </div>

              <div class="collapse" id="collapsePagos">
                <div class="card border-primary card-body">
                  <!-- aca empieza los pagos -->
                  <?php
                  $sqlsocio = "SELECT apellidos,nombres FROM socios WHERE dni='" . $dni . "'";
                  $cabe = mysqli_query($link, $sqlsocio);
                  $socio = mysqli_fetch_array($cabe);

                  $sql = "SELECT de.periodo,de.id_codigo,de.detalle_codigo,de.descuento,de.importe,re.id_recibo,re.id_op,re.rec_fecha
                                  FROM recibo re
                                  INNER JOIN op_detalles de ON re.id_op=de.id_op
                                  INNER JOIN o_pagos op ON de.id_op=op.id_op
                                  INNER JOIN socios so on so.dni=op.socio 
                                  WHERE  so.dni='" . $dni . "' AND  YEAR(re.rec_fecha) = $ano";

                  $res = mysqli_query($link, $sql);

                  $cantfila = mysqli_num_rows($res);

                  if ($cantfila > 0) {
                  ?>

                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm" id="datatableConsulta" name="datatableConsulta" width="100%" cellpadding="0">
                          <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->
                          <thead class="table-primary">
                            <tr>
                              <th align="center">Período</th>
                              <th align="center">Fecha</th>
                              <th align="center">Código</th>
                              <th align="center">Actividad</th>
                              <th align="center">Desc</th>
                              <th align="center">Importe</th>
                              <th align="center">OP</th>
                              <th align="center">Recibo</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php

                            while ($reg = mysqli_fetch_array($res)) {
                            ?>

                              <tr class="odd gradeX">
                                <td><?php echo $reg["periodo"]; ?></td>
                                <td align="center"><?php echo formato_fecha_dd_mm_Y($reg["rec_fecha"]); ?></td>
                                <td align="center"><?php echo $reg["id_codigo"]; ?></td>
                                <td><?php echo $reg["detalle_codigo"]; ?></td>
                                <td align="right"><?php echo  number_format($reg["descuento"], 2, ',', '.'); ?></td>
                                <td align="right"><?php echo  number_format($reg["importe"], 2, ',', '.'); ?></td>
                                <td align="right"><?php echo $reg["id_op"]; ?></td>
                                <td align="right"><?php echo $reg["id_recibo"]; ?></td>
                              </tr>

                            <?php
                            }
                            ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>El socio : <?php echo $dni; ?></strong> No Registra Pagos durante este año.
                    </div>
                  <?php

                  }

                  ?>
                  <!-- </div> -->



                  <!-- fin de los pagos -->
                </div>
              </div>




            </div><!--  fin de card body-->






          </div> <!--  fin de card -->
          <!--  <div  class="row" id="resultados_ajax"></div> -->



        </div>
      </div>
      <div class="collpse" id="collapseOp">
        <div class="row">
          <div class="col-12">
            <!--  Confección de Orden de Pago -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Confección de Orden de Pago<div class="float-right">
                    <h4><strong><?php echo $hoy; ?></strong></h4>
                  </div>
                </h5>
                <br>


                <form id="frm-op" name="frm-op">

                  <input type="hidden" id="hoy" name="hoy" value="<?php echo $hoy; ?>">
                  <input type="hidden" id="ano" name="ano" value="<?php echo $ano; ?>">
                  <input type="hidden" id="dni" name="dni" value="<?php echo $dni; ?>">
                  <div class="form-row">

                    <div class="form-group col-md-3">
                      <label for="codigo" class="text-info">Código De Pago</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button class="btn btn btn-primary" data-toggle="modal" data-target="#modalCodigo" id="espacio" name="espacio" type="button"><i class="fa fa-search"></i></button>
                        </div>
                        <input type="text" class="form-control " id="codigo" name="codigo" placeholder="Código de Pago">
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="periodo" class="text-info">Período (MES)</label>
                      <select class="custom-select form-control" id="periodo" name="periodo">
                        <?php

                        for ($i = 1; $i <= 12; $i++) {
                        ?>
                          <option <?php if ($i == $mes) {
                                    echo "selected ";
                                  }  ?>value="<?php echo $i;  ?>"><?php echo $i;  ?> </option>
                        <?php
                        }
                        ?>

                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="Descuento" class="text-info">Descuento %</label>
                      <input type="text" class="form-control" id="descuento" name="descuento" placeholder="% de Descuento">
                    </div>

                    <div class="form-group col-md-3">
                      <br>
                      <button type="submit" class="btn btn-primary mt-2" id="carga_codigo" name="carga_codigo">Cargar Código</button>
                    </div>

                    <div class="form-group col-md-12" id="codNombre"></div>

                  </div>
                  <!--fin de form-row-->

                </form>
                <div id="detalle_ajax"></div>

              </div>
              <!--fin de body-card-->
            </div>
            <!--fin card-->



          </div>




          <!--         <div id="resultados_ajax"></div> -->



        </div><!--  fin de row -->
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
  <?php include('modal/cerrar_sesion.php') ?>
  <!-- Bootstrap core JavaScript-->
  <!-- Core plugin JavaScript-->
  <!-- Custom scripts for all pages-->
  <?php include('include/librerias_js.php') ?>
  </div>
  <script type="text/javascript" src="js/op.js"></script>




  <!-- Modal -->
  <div class="modal fade " id="modalCodigo" tabindex="-1" role="dialog" aria-labelledby="modalCodigo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Códigos de Cobranza</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Example DataTables Card-->
          <div class="card mb-3">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm" id="dataTablecodigo" name="dataTablecodigo" width="100%" cellpadding="0">
                  <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Actividad</th>
                      <th>Categoría</th>
                      <th>Importe</th>
                      <th>Seleccionar</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    //require_once("conexion.php");
                    global $link;

                    $sql_cli = "SELECT co.id_codigo,co.cod_precio,c.ca_nombre,a.ac_nombre, c.id_categoria,a.id_actividad FROM codigos as co
                                    INNER JOIN categorias c ON  c.id_categoria=co.id_categoria
                                    INNER JOIN actividades a ON a.id_actividad=co.id_actividad";

                    // $sql_cli="SELECT codigos.id_codigo,codigos.cod_periodo,codigos.id_actividad,codigos.id_categoria,codigos.cod_precio,categorias.ca_nombre FROM codigos INNER JOIN categorias WHERE codigos.id_categoria=categorias.id_categoria";

                    $res_cli = mysqli_query($link, $sql_cli);

                    while ($reg_cli = mysqli_fetch_array($res_cli)) {
                    ?>

                      <tr class="odd gradeX ">

                        <td><?php echo $reg_cli["id_codigo"]; ?></td>
                        <td><?php echo $reg_cli["ac_nombre"]; ?></td>
                        <td><?php echo $reg_cli["ca_nombre"]; ?></td>
                        <td style="text-align: right;">
                          <?php echo "$ " . number_format($reg_cli["cod_precio"], 2, ',', '.'); ?>
                          <!-- <?php echo $reg_cli["cod_precio"]; ?> -->

                        </td>
                        <td style="text-align: center;">


                          <button type="button" class="btn btn-outline-dark btn-sm btnElegir " data-toggle="modal" data-target="#Modal-modif-codigo">
                            <i class="fa fa-check-square" aria-hidden="true"></i></button>


                          </a>



                        </td>

                        <input type="hidden" name="codigo" id="codigo_<?php echo $reg_cli["id_codigo"]; ?>" value="<?php echo $reg_cli["id_codigo"]; ?>">
                        <input type="hidden" name="importe" id="importe_<?php echo $reg_cli["id_codigo"]; ?>" value="<?php echo $reg_cli["cod_precio"]; ?>">
                        <input type="hidden" name="actividad" id="actividad_<?php echo $reg_cli["id_codigo"]; ?>" value="<?php echo $reg_cli["id_actividad"]; ?>">
                        <input type="hidden" name="categoria" id="categoria_<?php echo $reg_cli["id_codigo"]; ?>" value="<?php echo $reg_cli["id_categoria"]; ?>">
                      </tr>

                    <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">
            </div> -->
          </div> <!-- card -->

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
  </div>
  <script>



  </script>

</body>

</html>