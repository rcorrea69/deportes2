  <?php
     require_once("conexion.php");  

     $sqlloca="SELECT * FROM categorias ";
     $resultado=mysqli_query($link, $sqlloca);

     // $sqlcondicion="SELECT * FROM condicion "; 
     // $res=mysqli_query($link, $sqlcondicion );  

     $sqlactividad="SELECT * FROM actividades "; 
     $resact=mysqli_query($link, $sqlactividad );  

   ?> 




<div class="modal" tabindex="-1" role="dialog" id="Modal-alta-codigo" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Códigos de Cobranzas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cierre">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form  method="post" id="guardar_actividad" name="guardar_actividad"> 
            <div id="resultados_ajax"></div> 

              <div class="form-group input-group-sm row">    
                  <label for="codigo" class="control-label col-3">Código</label>          
                  <input type="text" class="form-control col-8" name="codigo" id="codigo" placeholder="Código" style="text-align: right;" />
              </div>

              <div class="form-group input-group-sm row">    
                                        
                          <label for="actividad" class="control-label col-3">Actividad</label>        

                          <select name="actividad" size="1" id="actividad" class="form-control col-8"> 

                              <?php while ($fila1=mysqli_fetch_assoc($resact)){ ?>
                                  <?php if($id_actividad==1){?>
                                      <option value="<?php echo $fila1['id_actividad']?>"><?php echo $fila1['ac_nombre']?></option>
                                            <?php }
                                       else {?>
                                            <option <?php if($fila1["id_actividad"]==1){echo "selected ";}?>value="<?php echo $fila1["id_actividad"];?>"><?php echo $fila1["ac_nombre"];?></option>
                                            <?php }?>
                              <?php }?>
                            </select>

              </div>
              
              <div class="form-group input-group-sm row">    
                                        
                          <label for="catego" class="control-label col-3">Categoría</label>        

                          <select name="catego" size="1" id="catego" class="form-control col-8"> 

                              <?php while ($fila=mysqli_fetch_assoc($resultado)){ ?>
                                  <?php if($id_categoria==1){?>
                                      <option value="<?php echo $fila['id_categoria']?>"><?php echo $fila['ca_nombre']?></option>
                                            <?php }
                                       else {?>
                                            <option <?php if($fila["id_categoria"]==1){echo "selected ";}?>value="<?php echo $fila["id_categoria"];?>"><?php echo $fila["ca_nombre"];?></option>
                                            <?php }?>
                              <?php }?>
                            </select>

              </div>
              
              <!-- <div class="form-group input-group-sm row">    
                                        
                          <label for="condicion" class="control-label col-3">Condición</label>        

                          <select name="condicion" size="1" id="condicion" class="form-control col-8"> 

                              <?php while ($fila=mysqli_fetch_assoc($res)){ ?>
                                  <?php if($id_condicion==1){?>
                                      <option value="<?php echo $fila['id_condicion']?>"><?php echo $fila['con_nombre']?></option>
                                            <?php }
                                       else {?>
                                            <option <?php if($fila["id_condicion"]==1){echo "selected ";}?>value="<?php echo $fila["id_condicion"];?>"><?php echo $fila["con_nombre"];?></option>
                                            <?php }?>
                              <?php }?>
                            </select>

                </div>   -->

                <div class="form-group input-group-sm row">    
                          <label for="importe" class="control-label col-3">Importe</label>          
                          <input type="text" class="form-control col-7" name="importe" id="importe" placeholder="" style="text-align: right;" />
                          <span class="input-group-addon col-1"><i>$</i></span>
                </div> 





      </div>
      <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardar_datos">Grabar</button>
           </form>
      </div>
    </div>
  </div>
</div>