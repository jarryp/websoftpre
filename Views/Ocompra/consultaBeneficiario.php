<div class="modal"
     id="modal_beneficiarios"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Benficiarios</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <!--
                <div class="form-group">
                  <input class="form-control" type="text" id="cadena" name="cadena" maxlength="60" placeholder="Cadena de Caracteres para Busqueda">
                  <button type="button" class="btn btn-primary" onclick="filtroEspecifica2()">Buscar</button>
               </div>
                -->
               <div id="area_resultados" class="form-group" style="height: 400px; overflow-y: scroll;">
               	 <div class="table-responsive">
                    <table class="display" id="tablaBeneficiarios">
                    <thead>
                        <tr>
                        <th>TIPO</th>
                        <th>CODIGO</th>
                        <th>NOMBRE / RAZON SOCIAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $json= file_get_contents(URL."Funciones/listaBeneficiarios?id_entidad=".$_SESSION['id_entidad']);
                            $datos = json_decode($json);
                            foreach($datos as $lb){
                                ?>
                                <tr>
                                    <td><?php echo $lb->tipo; ?> </td>
                                    <td>
                                     <a href="javascript:pasarBenf('<?php echo $lb->id_tipo_beneficiario?>','<?php echo $lb->codigo?>')">
                                      <?php echo $lb->codigo; ?>
                                     </a> 
                                    </td>
                                    <td><?php echo $lb->nombre; ?> </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                    </table>
               	 </div>       
               </div>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>