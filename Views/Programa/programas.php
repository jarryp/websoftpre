<div id="page-wrapper">
    <div id="page-inner">

    	   	      <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Programas <small>2do. Nivel de Clasificación Presupuestaria</small>
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
       	<table class="display" id="tablaPrograma">
       	 <thead>
         <tr>
          <th>COD PROG</th>
          <th>PROGRAMA</th>
          <th>COD SEC</th>
          <th>SECTOR</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                $json= file_get_contents(URL."Programa/listado?id_periodo=".$_SESSION['id_periodo']);
                $datos = json_decode($json);
                      foreach($datos as $programa){
                        echo "<tr>
                            <td> ". $programa->cod_programa."</td>
                            <td> ". $programa->programa ."</td>
                            <td> ". $programa->cod_sector ."</td>
                            <td> ". $programa->sector ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($programa->id_programa)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($programa->id_programa)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Programa</h4>
            </div>
        <div class="modal-body">
            <form role="form">

              <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select id="cmbSector" class="form-control">
                    <option value="S">-- Seleccione --</option>
                <?php
                $json= file_get_contents(URL."Sector/listado?id_periodo=".$_SESSION['id_periodo']);
                $datos = json_decode($json);
                foreach($datos as $sector){
                  echo "<option value='$sector->id_sector'> $sector->cod_sector - $sector->nombre </option>";
                }
                ?>
                  </select>
               </div>
               <div class="form-group">
                  <input class="form-control" type="text" id="cod_programa" name="cod_programa" maxlength="2" placeholder="Código de Programa" onblur="consulta()">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" id="nombre" name="nombre" maxlength="80" placeholder="Denominación">
                </div>
                <div class="form-group">
                  <textarea id="descripcion" name="descripcion" rows="6" class="form-control
                  " placeholder="Descripción"></textarea>
                </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_programa()">Guardar</button>
                <div class="form-group">
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
          function verventanamodal(){
              $("#area_mensaje").html("");
              document.getElementById("id").value="";
              document.getElementById("cod_programa").value="";
              document.getElementById("nombre").value="";
              document.getElementById("descripcion").value="";
              $("#ventana").modal("show");
              document.getElementById("cod_programa").focus();
            }

            function verventanamodalEditar(id_programa){
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Programa/consulta",
                  data:{id:id_programa},
                  success:function(response){
                    xdato = response.split("#");
                    if(xdato[0].trim()=="A"){
                      document.getElementById("id").value           = xdato[1].trim();
                      document.getElementById("cmbSector").value    = xdato[3].trim();
                      document.getElementById("cod_programa").value = xdato[2].trim();
                      document.getElementById("nombre").value       = xdato[4].trim();
                      document.getElementById("descripcion").value  = xdato[5].trim();
                    }
                  }
                });
                $("#area_mensaje").html("");
                $("#ventana").modal("show");
            }

            function consulta(){
              var xid_sector    = document.getElementById("cmbSector").value; 
              var xcod_programa = document.getElementById("cod_programa").value.trim();
              $.ajax({
                type:"POST",
                url:"<?php echo URL;?>Programa/consulta2",
                data:{id_sector:xid_sector,cod_programa:xcod_programa},
                success:function(response){
                  var xdato = response.split("#");
                  if(xdato[0]=="A"){
                    document.getElementById("id").value           = xdato[1].trim();
                    document.getElementById("nombre").value       = xdato[4].trim();
                    document.getElementById("descripcion").value  = xdato[5].trim();
                  }
                }
              });
            }


            function envia_programa(){
              //obtener valores ingresados por el usuario
              var xid_sector    = document.getElementById("cmbSector").value;
              var xcod_programa = document.getElementById("cod_programa").value;
              var xnombre       = document.getElementById("nombre").value.trim();
              var xdescripcion  = document.getElementById("descripcion").value.trim();
              var xid_usuario   = "<?php echo $_SESSION['idusuario']?>"; 
              //validación de ingreso de datos
              if(xid_sector=="" || xcod_programa=="" || xnombre==""){
                alert("Datos requeridos vacios");
              }else{
                var xid = document.getElementById("id").value;
                if(xid==""){
                  //codigo para agregar
                  $.ajax({
                    type:"POST",
                    url: "<?php echo URL;?>Programa/add",
                    data:{id_sector:xid_sector,cod_programa:xcod_programa,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
                    success:function(response){
                      $("#area_mensaje").html(response);
                    }
                  });
                }else{
                  //codigo para actualizar registro
                  $.ajax({
                    type:"POST",
                    url: "<?php echo URL;?>Programa/update",
                    data:{id:xid,id_sector:xid_sector,cod_programa:xcod_programa,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
                    success:function(response){
                      $("#area_mensaje").html(response);
                    }
                  });
                }
              } // fin de else de validacion de datos minimos requeridos
            } // llave de fin de creación de la functión 

            $(document).ready(function(){
                $("#tablaPrograma").DataTable({
                    "order": [[2, "asc"],[0, "asc"]],
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