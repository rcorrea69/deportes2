<?php
   require_once("conexion.php");                    
   $sqlloca="SELECT * FROM localidades ";
   $resultado=mysqli_query($link, $sqlloca);
 ?>  




<div class="modal" tabindex="-1" role="dialog" id="Modal-alta-categoria" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form  method="post" id="guardar_categoria" name="guardar_categoria"> 
            <div id="resultados_ajax"></div> 
              <div class="form-group">    
                  <label for="nombreact" class="control-label">Descripción de la Categoría</label>          
                  <input type="text" class="form-control" name="nombrecat" id="nombrecat" placeholder="Condición"/>
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

