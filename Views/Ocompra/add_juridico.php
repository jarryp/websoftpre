<div class="modal"
     id="addJuridico"
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
                <h4 class="modal-title" id="myModalLabel">Añadir Proveedor Juridico</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                    <input type="hidden" name="id_bjuridico" id="id_bjuridico" />
                    <input class="form-control" type="text" id="rif" name="rif" maxlength="30" placeholder="RIF: V162333255 (sin guiones)">
               </div>
               <div class="form-group">
                    <input class="form-control" type="text" id="nombre" name="nombre" maxlength="100" placeholder="Nombre / Razon Social">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" id="telefono" name="telefono" maxlength="15" placeholder="0276-762-53-69">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" id="email" name="email" maxlength="100" placeholder="usuario@dominio.com">
                </div>
                <div class="form-group">
                    <textarea id="direccion" name="direccion" rows="5" cols="50" placeholder="Dirección" class="form-control"></textarea>
                </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javaescript:envia_juridico()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>


