
<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Arreglos Internos <small>Registro principal beneficiarios de caracter interno</small>
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
       	<table class="display" id="tablaInterno">
       	 <thead>
         <tr>
          <th>CODIGO</th>
          <th>DESCRIPCION</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Interno/listado");
                      $datos = json_decode($json);
                      foreach($datos as $interno){
                        echo "<tr>
                            <td> ". $interno->id_interno."</td>
                            <td> ". $interno->descripcion ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($interno->id_interno)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($interno->id_interno)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Beneficiario Interno</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
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


 <script>

            $(document).ready(function(){
                $("#tablaInterno").DataTable({
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
                 document.getElementById("descripcion").value = "";
                 $("#ventana").modal("show");
                 document.getElementById("descripcion").focus();
            }

            


         function envia_interno(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xdescripcion  = document.getElementById("descripcion").value.trim();

              if(xid_entidad=="" || xid_usuario=="" || xdescripcion==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Interno/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion},
                  success:function(response){
                    if(response.trim()=="1"){
                      alert("Registro Agregado Satisfactoriamente");
                    }else{
                      alert("Error de Registro de Datos");
                    }
                  }

                });


              }else{

                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Interno/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion},
                  success:function(response){
                    if(response.trim()=="1"){
                      alert("Registro Actualizado Satisfactoriamente");
                    }else{
                      alert("Error de Actualización de Datos");
                    }
                  }
                });

              }
              } 
            }


</script>