<div class="modal"
     id="addInterno"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Añadir Beneficiario Interno</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id_binterno" id="id_binterno" />
                  <input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="60" placeholder="Descripcion">
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_interno()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>