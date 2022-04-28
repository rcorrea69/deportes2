<?php

$dni = $_POST["dni"];
$ano = $_POST["ano"];

//echo $ano;


require_once "../conexion.php";

include "../include/header.php";
include "../include/funciones.php";

$sqlsocio="SELECT apellidos,nombres FROM socios WHERE dni='".$dni."'";
$cabe=mysqli_query($link,$sqlsocio);
$socio=mysqli_fetch_array($cabe);

$sql="SELECT de.periodo,de.id_codigo,de.detalle_codigo,de.descuento,de.importe,re.id_recibo,re.id_op,re.rec_fecha
        FROM recibo re
        INNER JOIN op_detalles de ON re.id_op=de.id_op
        INNER JOIN o_pagos op ON de.id_op=op.id_op
        INNER JOIN socios so on so.dni=op.socio 
        WHERE  so.dni='".$dni."' AND  YEAR(re.rec_fecha) = $ano";

$res=mysqli_query($link,$sql);

$cantfila=mysqli_num_rows($res);

if ($cantfila > 0) {

?>         
       


          <div class="card  border-primary ">
             <div class="card-header  text-white  bg-dark">
                <h5> Socio : <?php echo $dni." ".$socio['apellidos']." ".$socio['nombres']  ?> </h5>
                   
             </div>
          <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm" id="datatableConsulta" name="datatableConsulta" width="100%" cellpadding="0" >
           <!--  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"> -->  
              <thead>
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
                 
                  while ($reg=mysqli_fetch_array($res))
                               {
                ?>

                  <tr class="odd gradeX">
                      <td><?php echo $reg["periodo"];?></td>
                      <td align="center"><?php echo formato_fecha_dd_mm_Y( $reg["rec_fecha"]);?></td>
                      <td align="center"><?php echo $reg["id_codigo"];?></td>
                      <td><?php echo $reg["detalle_codigo"];?></td>
                      <td align="right"><?php echo  number_format($reg["descuento"] , 2, ',', '.') ;?></td>
                      <td align="right"><?php echo  number_format($reg["importe"] , 2, ',', '.') ;?></td>
                      <td align="right"><?php echo $reg["id_op"];?></td>
                      <td align="right"><?php echo $reg["id_recibo"];?></td>                    
                  </tr>

                <?php
                                }
                ?>

              </tbody>
            </table>
          </div>
          </div>
          </div> 
          <script type="text/javascript">
        
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
    
      </script>


<?php  
}
else {

            ?>
            <br>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>El Socio no registra pagos en el año consultado</strong> 
                    
            </div>
            <?php

}




include "../include/librerias_js.php";



mysqli_close($link);

?>