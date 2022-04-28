<?php require 'include/validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('include/header.php'); ?>
  <?php require_once("include/funciones.php");?>
  <style>
      table.dataTable thead {
        background: linear-gradient(to right, #1a1487, #be3a4a, #11333b);
            /* background: linear-gradient(to right, #1a1487, #be683a, #1c7c90); */
            /* background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4); */
            color:white;
        }
  </style>
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
        <li class="breadcrumb-item active">Panel de Socios</li>
      </ol>
      <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                  <div class="btn-group pull-right">
                    <div>
                      <a href="socios.php" class="btn btn-outline-primary" title="Cargar nuevo socio"> <i class="fa fa-plus" aria-hidden="true"></i> Agregar socio </a>  
                    </div>
                  </div>
                  <i class="fa fa-table"></i> Socios
                </div> <!-- card-header -->


                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm" id="tablaUsuarios" name="tablaUsuarios" width="100%" cellpadding="0" >
                  
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Apellidos</th>
                          <th>Nombres</th>
                          <th>Apto Médico</th>
                          <th style="text-align: center;">Acciones</th>
                        </tr>
                      </thead>
                    </table>
                  </div> <!-- table-responsive -->
                </div> <!-- card body -->
            </div><!-- card mb-3 -->
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
    <!-- <script type="text/javascript" src="js/panel_socios.js"></script>  -->
    <!--  <script type="text/javascript" src="js/actividad.js"></script>  -->
     <script>
        $(document).ready(function(){
           $("#tablaUsuarios").DataTable({
              "processing": true,
              "serverSide": true,
              "sAjaxSource": "ServerSide/serversideUsuarios.php",
              "columnDefs":[{
                  "data":null,
                  "targets": -1,
                    "defaultContent": "<div class='text-center'><div class='btn-group'>"+
                                            "<button class='btn btn-outline-dark btn-sm ml-2 btnOp' title='Generar Orden de Pago'><i class='fa fa-money' aria-hidden='true'></i></button>"+
                                            "<button class='btn btn-outline-primary btn-sm btnConsulta' title='Consulta de Pagos'><i class='fa fa-history' aria-hidden='true'></i></button>"+
                                            "<button class='btn btn-outline-success btn-sm btn-sm btnActividades' title='Actutalizar y Visualizar actividades'><i class='fa fa-futbol-o' aria-hidden='true'></i></button>"+
                                            "<button class='btn btn-outline-danger btn-sm btn-sm btnEditar' title='Editar Socio'><i class='fa fa-edit' aria-hidden='true'></i></button>"+
                                            "</div></div>"  
                    //"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
              }],

                      //Para cambiar el lenguaje a español<i class="fas fa-edit"></i>
                "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "sProcessing":"Procesando...",
                    }   
                   
           }); 

            $(document).on("click", ".btnOp", function(){
                fila = $(this).closest("tr");
                id = fila.find('td:eq(0)').text();
                url = "op.php?dni="+id;
                $(location).attr('href',url);
                
            });

            $(document).on("click", ".btnConsulta", function(){
                fila = $(this).closest("tr");
                id = parseInt(fila.find('td:eq(0)').text());
                url = "pagos_socio.php?dni="+id;
                $(location).attr('href',url);
                
            });

            $(document).on("click", ".btnActividades", function(){
                fila = $(this).closest("tr");
                id = parseInt(fila.find('td:eq(0)').text());
                url = "socio_actividad.php?dni="+id;
                $(location).attr('href',url);
                
            });

            $(document).on("click", ".btnEditar", function(){
                fila = $(this).closest("tr");
                id = parseInt(fila.find('td:eq(0)').text());
                url = "modif_socios.php?dni="+id;
                $(location).attr('href',url);
                
            });
        });
    </script> 

</body>

</html>
