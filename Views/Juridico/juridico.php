<div id="page-wrapper">
 <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Juridicos <small>Registro principal beneficiarios de ordenes de pago</small>
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
       	<table class="display" id="tablaJuridico">
       	 <thead>
         <tr>
          <th>RIF</th>
          <th>RAZON SOCIAL</th>
          <th>TELEFONO</th>
          <th>EMAIL</th>
          <th>DIRECCION</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json  = file_get_contents(URL."Juridico/listado");
                      $datos = json_decode($json);
                      foreach($datos as $ljuridico){
                        echo "<tr>
                            <td> ". $ljuridico->rif."</td>
                            <td> ". $ljuridico->nombre ."</td>
                            <td> ". $ljuridico->telefono ."</td>
                            <td> ". $ljuridico->email ."</td>
                            <td> ".$ljuridico->direccion."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($ljuridico->id)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($ljuridico->id)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Proveedor Juridico</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" />
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




<script>

            function verventanamodal(){
                 document.getElementById("id").value        ="";
                 document.getElementById("rif").value       = "";
                 document.getElementById("nombre").value    = "";
                 document.getElementById("telefono").value  = "";
                 document.getElementById("email").value     = "";
                 document.getElementById("direccion").value = "";
                 document.getElementById("rif").focus();
                 $("#ventana").modal("show");
            }

            function envia_juridico(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xrif        = document.getElementById("rif").value.trim();
              var xnombre     = document.getElementById("nombre").value.trim();
              var xtelefono   = document.getElementById("telefono").value.trim();
              var xemail      = document.getElementById("email").value.trim();
              var xdireccion  = document.getElementById("direccion").value.trim();

              if(xid_entidad=="" || xid_usuario=="" || xrif=="" || xnombre=="" || xdireccion==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Juridico/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,rif:xrif,nombre:xnombre,telefono:xtelefono,email:xemail,direccion:xdireccion},
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
                  url:"<?php echo URL;?>Juridico/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,rif:xrif,nombre:xnombre,telefono:xtelefono,email:xemail,direccion:xdireccion},
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


            function verventanamodalEditar(id){
                $.ajax({
                    type:"POST",
                    url:"<?php echo URL;?>Juridico/consulta",
                    data:{id:id},
                    success:function(response){
                        var xdata = response.split("#");
                        if(xdata[0]=="A"){
                            
                            document.getElementById("id").value=id;
                            document.getElementById("rif").value       = xdata[1].trim();
                            document.getElementById("nombre").value    = xdata[2].trim();
                            document.getElementById("telefono").value = xdata[3].trim();
                            document.getElementById("email").value     = xdata[4].trim();
                            document.getElementById("direccion").value = xdata[5].trim();
                            document.getElementById("rif").focus();
                            $("#ventana").modal("show");
                                        
                        }else{
                          alert("Error de Consulta");
                        }
                    }
                });

                
            }


            $(document).ready(function(){
                $("#tablaJuridico").DataTable({
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
</script>