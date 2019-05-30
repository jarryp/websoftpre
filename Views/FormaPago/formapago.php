<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Formas de Pago <small>Registro principal de formas de pago para emisión de recibos de caja</small>
    </h1>

    <div class="row">
    <div class="col-md-12">
     <button type="button"
             class="btn btn-primary"
             id="btn-nuevo"
             onclick="javascript:verventanamodal()">
             Agregar
     </button>
     <div class="panel panel-default">
      <div class="panel-heading">
       Listado General
      </div>
      <div class="panel-body">
       <div class="table-responsive">
       	<table class="display" id="tablaFormaPago">
       	 <thead>
         <tr>
          <th>FORMA DE PAGO</th>
          <th width="10%" align="center">EDITAR</th>
          <th width="10%" align="center">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."FormaPago/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $fp){
                        echo "<tr>
                            <td> ". $fp->descripcion ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($fp->id_forma_pago)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($fp->id_forma_pago)'>Elimiar</button></td>
                              </tr>";
                      }
                     ?>
         </tbody>
       	</table>
       </div> <!-- Fin de div para tabla-->
      </div> <!-- Fin de panel-Body-->
     </div> <!-- Fin de panel-default-->
    </div> <!-- Fin div 12 columnas-->
    </div> <!-- Fin div ROW-->
   </div>
  </div>
</div>
</div>

<div class="modal"
     id="ventana"
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Editar Formas de Pago</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="100" placeholder="Descripción">
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_formapago()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        <div class="row" id="area_mensaje"></div>
        </div>
    </div>
</div>


<script>

$(document).ready(function(){
                $("#tablaFormaPago").DataTable({
                    "order": [[1, "asc"]],
                    "language":{
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrada de _MAX_ registros)",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords":    "No se encontraron registros coincidentes",
                        "paginate": {
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    }
                });
            });

    function verventanamodal(){
        $("#descripcion").val("");
        $("#area_mensaje").html("");
        $("#ventana").modal("show");
        document.getElementById("descripcion").focus();
    }

    function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>FormaPago/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                  $("#id").val(xdata[1]);
                  $("#descripcion").val(xdata[2].trim());
                  $("#area_mensaje").html("");
                  $("#ventana").modal("show");
                  $("#descripcion").focus();                                  
                }else{
                    alert("Error de Consulta");
                }
              }
           });              
     }

     function envia_formapago(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xdescripcion     = $("#descripcion").val().trim();

              if(xid_entidad=="" || xid_usuario=="" || xdescripcion==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>FormaPago/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }else{
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>FormaPago/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }
              } 
            }

</script>