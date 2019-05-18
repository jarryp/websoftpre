<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Bancos <small>Registro principal entidades bancarias</small>
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
       	<table class="display" id="tablaBanco">
       	 <thead>
         <tr>
          <th>NOMBRE</th>
          <th>DESCRIPCION</th>
          <th width="10%">EDITAR</th>
          <th width="10%">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Banco/listado");
                      $datos = json_decode($json);
                      foreach($datos as $banco){
                        echo "<tr>
                            <td> ". $banco->nombre."</td>
                            <td> ". $banco->descripcion ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($banco->id_banco)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($banco->id_banco)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Registro de Bancos</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="nombre" name="nombre" maxlength="100" placeholder="Nombre">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="4" cols="60" placeholder="Breve descripción" name="descripcion" id="descripcion"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_banco()">Guardar</button>
               <div class="row">
                    <div id="area_mensaje"></div>
                </div>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>


<script>
   $(document).ready(function(){
                $("#tablaBanco").DataTable({
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
      document.getElementById("nombre").value = "";
      document.getElementById("descripcion").value = "";
      $("#area_mensaje").html("");
      $("#ventana").modal("show");
      document.getElementById("nombre").focus();
   }


   function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>Banco/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                            document.getElementById("id").value     = xdata[1].trim();
                            document.getElementById("nombre").value = xdata[2].trim();
                            $("#descripcion").val(xdata[3].trim());
                            $("#area_mensaje").html("");
                            $("#ventana").modal("show");                                        
                        }else{
                          alert("Error de Consulta");
                        }
                    }
                });

                
            }



   function envia_banco(){
        if($("#nombre").val().trim()!="" &&  $("#descripcion").val().trim()!=""){
          var xid_entidad   = "<?php echo $_SESSION['id_entidad']?>";
          var xid_usuario   = "<?php echo $_SESSION['idusuario']?>";
          var xdescripcion  = $("#descripcion").val().trim();
          var xnombre       = $("#nombre").val().trim();
          var xid           = $("#id").val().trim();
           if(xid==""){
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Banco/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,
                        nombre:xnombre,descripcion:xdescripcion},
                  success:function(response){
                      $("#area_mensaje").html(response);
                  }

                });
           }else{
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Banco/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,
                        nombre:xnombre,descripcion:xdescripcion},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
           }
        }else{
          alert("Ingrese nombre del beneficiario");   
        }
    }

</script>