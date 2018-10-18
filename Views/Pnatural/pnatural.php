<?php



?>


<div id="page-wrapper">
    <div id="page-inner">

   	      <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Persona Natural <small>Registro principal beneficiarios de ordenes de pago</small>
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
       	<table class="display" id="tablaPnatural">
       	 <thead>
         <tr>
          <th>CEDULA</th>
          <th>APELLIDOS</th>
          <th>NOMBRES</th>
          <th>TELEFONO</th>
          <th>EMAIL</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Pnatural/listado");
                      $datos = json_decode($json);
                      foreach($datos as $lpnatural){
                        echo "<tr>
                            <td> ". $lpnatural->cedula."</td>
                            <td> ". $lpnatural->apellidos ."</td>
                            <td> ". $lpnatural->nombres ."</td>
                            <td> ". $lpnatural->telefono ."</td>
                            <td> ". $lpnatural->email."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($lpnatural->id)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($lpnatural->id)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Persona Natural</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
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



 <script>

            $(document).ready(function(){
                $("#tablaPnatural").DataTable({
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



    function envia_pnatural(){
              var xid_entidad = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
              var xcedula     = document.getElementById("cedula").value.trim();
              var xnombres    = document.getElementById("nombres").value.trim();
              var xapellidos  = document.getElementById("apellidos").value.trim();
              var xtelefono   = document.getElementById("telefono").value.trim();
              var xemail      = document.getElementById("email").value.trim();
              var xdireccion  = document.getElementById("direccion").value.trim();

              if(xid_entidad=="" || xid_usuario=="" || xcedula=="" || xnombres=="" || xdireccion=="" || xapellidos==""){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Pnatural/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,cedula:xcedula,nombres:xnombres,apellidos:xapellidos,telefono:xtelefono,email:xemail,direccion:xdireccion},
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
                  url:"<?php echo URL;?>Pnatural/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,cedula:xcedula,nombres:xnombres,apellidos:xapellidos,telefono:xtelefono,email:xemail,direccion:xdireccion},
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


            function verventanamodal(){
                 document.getElementById("id").value        = "";
                 document.getElementById("cedula").value    = "";
                 document.getElementById("nombres").value   = "";
                 document.getElementById("apellidos").value = "";
                 document.getElementById("telefono").value  = "";
                 document.getElementById("email").value     = "";
                 document.getElementById("direccion").value = "";
                 document.getElementById("cedula").focus();
                 $("#ventana").modal("show");
            }


            function verventanamodalEditar(id){
                $.ajax({
                    type:"POST",
                    url:"<?php echo URL;?>Pnatural/consulta",
                    data:{id:id},
                    success:function(response){
                        var xdata = response.split("#");
                        if(xdata[0]=="A"){
                            
                            document.getElementById("id").value=id;
                            document.getElementById("cedula").value    = xdata[1].trim();
                            document.getElementById("nombres").value   = xdata[2].trim();
                            document.getElementById("apellidos").value = xdata[3].trim();
                            document.getElementById("telefono").value  = xdata[4].trim();
                            document.getElementById("email").value     = xdata[5].trim();
                            document.getElementById("direccion").value = xdata[6].trim();
                            document.getElementById("cedula").focus();
                            $("#ventana").modal("show");
                                        
                        }else{
                          alert("Error de Consulta");
                        }
                    }
                });

                
            }


</script>
