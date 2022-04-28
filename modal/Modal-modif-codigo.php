  <?php
     require_once("conexion.php");  

     $sqlloca="SELECT * FROM categorias ";
     $resultado=mysqli_query($link, $sqlloca);

     // $sqlcondicion="SELECT * FROM condicion "; 
     // $res=mysqli_query($link, $sqlcondicion );  

     $sqlactividad="SELECT * FROM actividades "; 
     $resact=mysqli_query($link, $sqlactividad ); 



   ?> 




<div class="modal" tabindex="-1" role="dialog" id="Modal-modif-codigo" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Códigos de Cobranzas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cierre">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form  method="post" id="modif_codigo" name="modif_codigo"> 
            <div id="resultados_ajax_modif"></div> 

              <div class="form-group input-group-sm row">    
                  <label for="codigo" class="control-label col-3">Código</label>          
                  <input type="text" class="form-control col-8" name="codigo-modif" id="codigo-modif" placeholder="Código" style="text-align: right;" />
              </div>

              <div class="form-group input-group-sm row">    
                                        
                          <label for="actividad" class="control-label col-3">Actividad</label>        

                          <select name="actividad-modif" size="1" id="actividad-modif" class="form-control col-8"> 
                              <?php while ($fila1=mysqli_fetch_assoc($resact)){ ?>
                                  <option value="<?php echo $fila1['id_actividad']?>"><?php echo $fila1['ac_nombre']?></option>
                              <?php }?>
                          </select>


              </div>
              
              <div class="form-group input-group-sm row">    
                                        
                          <label for="catego" class="control-label col-3">Categoría</label>        

                          <select name="categoria-modif" size="1" id="categoria-modif" class="form-control col-8">
                              <?php while ($fila=mysqli_fetch_assoc($resultado)){ ?>
                                  <option value="<?php echo $fila['id_categoria']?>"><?php echo $fila['ca_nombre']?></option>
                              <?php }?>
                          </select>

              </div>
              


                <div class="form-group input-group-sm row">    
                          <label for="importe-modif" class="control-label col-3">Importe</label>          
                          <input type="text" class="form-control col-7" name="importe-modif" id="importe-modif" placeholder="" style="text-align: right;"  />
                          <span class="input-group-append col-1"><i>$</i></span>
                </div> 


      </div>
      <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="modificar_codigo">Grabar Modificación</button>
           </form>
      </div>
    </div>
  </div>
</div>