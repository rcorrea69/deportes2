
<div class="modal" tabindex="-1" role="dialog" id="Modal-alta-condicion" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Condición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form  method="post" id="guardar_condicion" name="guardar_condicion"> 
            <div id="resultados_ajax"></div> 
              <div class="form-group">    
                  <label for="nombreact" class="control-label">Descripción de la Condición</label>          
                  <input type="text" class="form-control" name="nombrecon" id="nombrecon" placeholder="Condición"/>
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

