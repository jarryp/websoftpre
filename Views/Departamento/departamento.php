
<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Departamentos <small>Registro principal de departamentos</small>
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
       	<table class="display" id="tablaDepartamento">
       	 <thead>
         <tr>
          <th>DEPARTAMENTO</th>
          <th width="10%" align="center">EDITAR</th>
          <th width="10%" align="center">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Departamento/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $dpto){
                        echo "<tr>
                            <td> ". $dpto->nombre ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($dpto->id_departamento)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($dpto->id_departamento)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Editar Departamentos</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="nombre" name="nombre" maxlength="100" placeholder="Nombre del Departamento">
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_departamento()">Guardar</button>
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
                $("#tablaDepartamento").DataTable({
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
        $("#nombre").val("");
        $("#area_mensaje").html("");
        $("#ventana").modal("show");
        document.getElementById("nombre").focus();
  }

  function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>Departamento/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                  $("#id").val(xdata[1]);
                  $("#nombre").val(xdata[2].trim());
                  $("#area_mensaje").html("");
                  $("#ventana").modal("show");
                  $("#nombre").focus();                                  
                }else{
                    alert("Error de Consulta");
                }
              }
           });              
     }


    function envia_departamento(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xnombre     = $("#nombre").val().trim();

              if(xid_entidad=="" || xid_usuario=="" || xnombre==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Departamento/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,nombre:xnombre},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }else{
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Departamento/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,nombre:xnombre},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }
              } 
            }


</script>