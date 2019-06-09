<div class="modal"
     id="addNatural"
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
                <h4 class="modal-title" id="myModalLabel">Añadir Persona Natural</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id_bnatural" id="id_bnatural" />
                  <input class="form-control" type="text" id="cedula" name="cedula" maxlength="10" placeholder="V16233325 (sin guiones y la letra en mayuscula)">
               </div>
               <div class="form-group">
                    <input class="form-control" type="text" id="nombres" name="nombres" maxlength="40" placeholder="Nombres">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" id="apellidos" name="apellidos" maxlength="40" placeholder="Apellidos">
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
                          onclick="javaescript:envia_pnatural()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>


