<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Cargos <small>Registro principal de cargos</small>
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
       	<table class="display" id="tablaCargos">
       	 <thead>
         <tr>
          <th>CARGOS</th>
          <th width="10%" align="center">ESTATUS</th>
          <th width="10%" align="center">CONFIANZA</th>
          <th width="10%" align="center">EDITAR</th>
          <th width="10%" align="center">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Cargo/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $cargo){
                        echo "<tr>
                            <td> ". $cargo->descripcion ."</td>";
                            if($cargo->estatus=="SI"){
                              echo "<td align='center'>Activo</td>";
                            }else{
                              echo "<td align='center'>Inactivo</td>";
                            }
                            if($cargo->confianza=="SI"){
                              echo "<td align='center'>SI</td>";
                            }else{
                              echo "<td align='center'>NO</td>";
                            }
                            echo "
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($cargo->id_cargo)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($cargo->id_cargo)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Editar Cargos</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="100" placeholder="Descripcion">
                  <div class="row" class="form-group">
                  <br> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="confianza" id="confianza">Cargo de Confianza
                    <input type="checkbox" checked="checked" name="estatus" id="estatus"> Estatus
                  </div>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_cargo()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        <div class="row" id="area_mensaje"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
                $("#tablaCargos").DataTable({
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
            url:"<?php echo URL;?>Cargo/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){ 
                  $("#id").val(xdata[1]);
                  $("#descripcion").val(xdata[2].trim());
                  //$("#confianza").selected(check(xdata[4]));
                  //$("#estatus").selected(check(xdata[3]));
                   document.getElementById("confianza").checked = check(xdata[4]);
                   document.getElementById("estatus").checked = check(xdata[3]); 
                  $("#area_mensaje").html("");
                  $("#ventana").modal("show");
                  $("#descripcion").focus();                                  
                }else{
                    alert("Error de Consulta");
                }
              }
           });              
     }


function envia_cargo(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xdescripcion     = $("#descripcion").val().trim();

              if(xid_entidad=="" || xid_usuario=="" || xdescripcion==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid        = document.getElementById("id").value.trim();
                var xconfianza = document.getElementById("confianza").checked;
                var xestado    = document.getElementById("estatus").checked;
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Cargo/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion,
                    estatus:xestado,confianza:xconfianza},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }else{
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Cargo/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion,
                    estatus:xestado,confianza:xconfianza},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }
              } 
            }



            function check(xvalor){
              if(xvalor.trim()=="0"){
                return false;
              }else{
                return true;
              }
            }


</script>