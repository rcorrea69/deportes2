<?php require 'include/validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>


   <?php include('include/header.php') ?>
  <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css">
  <?php
     require_once("conexion.php");  
     include('include/funciones.php');

     $sqlloca="SELECT * FROM categorias ";
     $resultado=mysqli_query($link, $sqlloca);

     $sqlcondicion="SELECT * FROM condicion "; 
     $res=mysqli_query($link, $sqlcondicion );  

     $sqlpais="SELECT * FROM pais "; 
     $respais=mysqli_query($link, $sqlpais ); 
     //die($sqlloca);



    if(isset($_GET['dni'])){

      $dni=$_GET['dni'];
    }  

     $sqlsocio="SELECT * FROM socios WHERE dni='".$dni."'"; 
     $ressocio=mysqli_query($link, $sqlsocio ); 
     $filasocio=mysqli_fetch_array($ressocio)
     //die($sqlsocio);
   ?>  
  
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
        <li class="breadcrumb-item active">Socios Ficha Personal</li>
      </ol>
      <div class="row">
        <div class="col-12">
            <div class="card border-primary">
              <div class="card-header  bg-secondary text-white">
                 <h5 class="text-white">Modificar Ficha de Socios</h5>
              
              </div>
              <div class="card-body ">
                 
                <div class="row">
                  <div class="col-12"> 
                   
                    <div id="resultados_ajax"></div>

                  <form method="post" autocomplete="off" name="modif_socios" id="modif_socios">


                    <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="dni" class="text-info">D.N.I</label>
                        <input type="text" class="form-control " id="dni" name="dni" placeholder="DNI" value="<?php echo $filasocio['dni']; ?>" readonly>
                      </div>

                      <div class="form-group col-md-2">
                        <label for="naci" class="text-info">Fecha Nacimiento</label>
                        <input type="text" class="form-control" id="naci" name="naci" placeholder="dd/mm/aaaa" value="<?php echo formato_fecha_dd_mm_Y($filasocio['fecha_nacimiento']) ; ?>">
                      </div>                        

                      <div class="form-group col-md-4">
                        <label for="nombres" class="text-info">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="<?php echo $filasocio['nombres']; ?>" >
                      </div>

                      <div class="form-group col-md-4">
                        <label for="apellido" class="text-info">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" value="<?php echo $filasocio['apellidos']; ?>">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="nacionalidad" class="text-info">País</label>
                        <select id="nacionalidad" name="nacionalidad"  class="form-control">
                          
                          
                          <?php while ($filapais=mysqli_fetch_array($respais)){
                           ?>
                                <option value="<?php echo $filapais['pais_nombre']?>"
                                 <?php if($filapais['pais_nombre']== $filasocio['nacionalidad']){ echo 'selected'; }; ?>  ><?php echo $filapais['pais_nombre']?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-5">
                        <label for="domicilio" class="text-info">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio"  placeholder="Domicilio" value="<?php echo $filasocio['domicilio']; ?>">
                      </div>

                      <div class="form-group col-md-2">
                        <label for="te1" class="text-info">Teléfono</label>
                        <input type="text" class="form-control" id="te1" name="te1"  placeholder="Teléfono" value="<?php echo $filasocio['telefono']; ?>">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="tel2" class="text-info">Celular</label>
                        <input type="text" class="form-control" id="tel2" name="tel2"  placeholder="Celular"value="<?php echo $filasocio['celular']; ?>">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="email" class="text-info">Mail</label>
                        <input type="Email" class="form-control" id="mail" name="mail"  placeholder="Email"value="<?php echo $filasocio['mail']; ?>">
                      </div>    
                      <div class="form-group col-md-2">
                        <label for="fecha" class="text-info">Apto Médico</label>
                        <input type="text" class="form-control" id="fecha" name="fecha"  placeholder="dd/mm/aaaa" value="<?php echo formato_fecha_dd_mm_Y($filasocio['fecha_apto']); ?>">
                      </div>    
                      <div class="form-group col-md-4">
                        <label for="cobertura" class="text-info">Cobertura Médica</label>
                        <input type="text" class="form-control" id="cobertura" name="cobertura"  placeholder="Cobertura" value="<?php echo $filasocio['cobertura']; ?>">
                      </div>
                    </div>

                    <div class="form-row">
                        <div class=" col-md-6  ">    
                          <label for="catego" class="control-label text-info ">Categoría</label>        
                          <select name="catego" size="1" id="catego" class="form-control "> 
                                <?php while ($fila=mysqli_fetch_assoc($resultado)){ ?>

                                <option value="<?php echo $fila['id_categoria']?>"
                                  <?php if($fila['id_categoria']== $filasocio['id_categoria'])
                                  { echo 'selected'; }; ?>  ><?php echo $fila['ca_nombre'];  ?></option>



                                <?php }?>
                            </select>
                      
                        </div>

 
                            <div class="form-group col-md-6">                              
                                <label for="condicion" class="control-label text-info">Condición</label>        

                                <select name="condicion" size="1" id="condicion" class="form-control col"> 

                                  <?php while ($fila=mysqli_fetch_array($res)){
                                  ?>
                                   <option value="<?php echo $fila['id_condicion']?>"
                                  <?php if($fila['id_condicion']== $filasocio['id_condicion'])
                                  { echo 'selected'; }; ?>  ><?php echo $fila['con_nombre'];  ?></option>
                                  
                               
                                  <?php } ?>    

                                </select>

                            </div>
                    </div>

                    <div class="row d-flex justify-content-end">

                           <button type="submit" class="btn btn-primary" id="guardar_datos">Actualizar datos del Socio</button>           
                    </div>

                  </form>


                  </div> <!-- columna 12 -->

              
                </div><!--  row -->

               
              </div> <!-- card body -->
            </div><!--  card -->



        </div><!-- columna 12 -->
      </div><!--  row -->
    </div><!-- /.container-fluid-->
    
   
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
      
      <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
      <script src="js/bootstrap-datepicker.min.js"></script>
      <script src="js/bootstrap-datepicker.es.min.js"></script>
      <script type="text/javascript" src="js/socios.js"></script> 

  </div> <!-- /.content-wrapper-->
</body>

</html>
