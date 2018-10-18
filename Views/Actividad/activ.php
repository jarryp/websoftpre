<div id="page-wrapper">
    <div id="page-inner">

    	   	      <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Actividades <small>4to. Nivel de Clasificación Presupuestaria</small>
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
       	<table class="display" id="tablaActividad">
       	 <thead>
         <tr>
          <th width="10">SEC</th>
          <th width="10">PROG</th>
          <th width="10">OBRA</th>
          <th width="10">COD_ACT</th>
          <th>DENOMINACION</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Actividad/listado?id_periodo=".$_SESSION['id_periodo']);
                      $datos = json_decode($json);
                      foreach($datos as $actividad){
                        echo "<tr>
                            <td> ". $actividad->cod_sector."</td>
                            <td> ". $actividad->cod_programa."</td>
                            <td> ". $actividad->cod_obra."</td>
                            <td> ". $actividad->cod_actividad."</td>
                            <td> ". $actividad->nombre ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($actividad->id_actividad)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($actividad->id_actividad)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Actividad</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select id="cmbSector" class="form-control" onchange="cargarPrograma()">
                    <?php
                      $json= file_get_contents(URL."Sector/listado?id_periodo=".$_SESSION['id_periodo']);
                      $datos = json_decode($json);
                      echo "<option value='S'>-- Seleccione --</option>";
                        foreach($datos as $sector){
                          echo "<option value='$sector->id_sector'> $sector->cod_sector - $sector->nombre </option>";
                        }
                    ?>
                    </select>
               </div>
               <div class="form-group">
                 <select id="cmbPrograma" class="form-control"  onchange="cargarObra()">
                   <option value="S">-- Seleccione --</option>
                 </select>
               </div>
               <div class="form-group">
                 <select id="cmbObra" class="form-control">
                   <option value="S">-- Seleccione --</option>
                 </select>
               </div>
               <div class="form-group">
                 <input type="text" name="cod_act" id="cod_act" maxlength="2" placeholder="Código de la Actividad" class="form-control" onblur="consulta()">
               </div>
               <div class="form-group">
                 <input type="text" name="nombre" id="nombre" maxlength="80" placeholder="Denominación" class="form-control">
               </div>
               <div class="form-group">
                 <textarea id="descripcion" name="descripcionn" placeholder="Descripción" rows="4" class="form-control"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_actividad()">Guardar</button>
             </form>
             <div id="area_mensaje"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<script>

  function verventanamodal(){
   document.getElementById("cmbSector").value="S";
   document.getElementById("cmbPrograma").value="S";
   document.getElementById("cmbObra").value="S";
   document.getElementById("cod_act").value="";
   document.getElementById("nombre").value="";
   document.getElementById("descripcion").value="";
   $("#ventana").modal("show");
   document.getElementById("cmbSector").focus();
  }

  function verventanamodalEditar(xid){
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Actividad/consulta2",
      data:{id:xid},
      success:function(response){
        xdato = response.split("#");
        if(xdato[0].trim()=="A"){
          document.getElementById("id").value          = xdato[1];
          document.getElementById("cmbSector").value   = xdato[4];
          document.getElementById("cod_act").value     = xdato[7];
          document.getElementById("nombre").value      = xdato[2];
          document.getElementById("descripcion").value = xdato[3];
          $.ajax({
              type:"POST",
              url:"<?php echo URL;?>Programa/cargarCmb",
              data:{id_sector:document.getElementById("cmbSector").value},
              success:function(response){
                $("#cmbPrograma").html(response);
                document.getElementById("cmbPrograma").value = xdato[5];
              }
            });
          $.ajax({
              type:"POST",
              url:"<?php echo URL;?>Obra/cargarCmb",
              data:{id_programa:xdato[5]},
              success:function(response){
                $("#cmbObra").html(response);
                document.getElementById("cmbObra").value = xdato[6];
              }
            });

        }
      }
    });


    $("#ventana").modal("show");
  }

  function cargarPrograma(){
    var xid_sector = document.getElementById("cmbSector").value;
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Programa/cargarCmb",
      data:{id_sector:xid_sector},
      success:function(response){
        $("#cmbPrograma").html(response);
      }
    });
  }

  function cargarObra(){
    var xid_programa = document.getElementById("cmbPrograma").value;
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Obra/cargarCmb",
      data:{id_programa:xid_programa},
      success:function(response){
        $("#cmbObra").html(response);
      }
    });
  }


  function consulta(){
    var xid_obra = document.getElementById("cmbObra").value;
    var xcod_act = document.getElementById("cod_act").value;
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Actividad/consulta",
      data:{id_obra:xid_obra,cod_act:xcod_act},
      success:function(response){
        var xdato = response.split("#");
        if(xdato[0].trim()=="A"){
          document.getElementById("id").value          = xdato[1];
          document.getElementById("nombre").value      = xdato[2].trim();
          document.getElementById("descripcion").value = xdato[3];
        }else{
          document.getElementById("id").value          = "";
          document.getElementById("nombre").value      = "";
          document.getElementById("descripcion").value = "";
        }
      }
    });
  }


  function envia_actividad(){
    var xid_obra     = document.getElementById("cmbObra").value;
    var xcod_act     = document.getElementById("cod_act").value;
    var xnombre      = document.getElementById("nombre").value.trim();
    var xdescripcion = document.getElementById("descripcion").value.trim();
    var xid_usuario  = "<?php echo $_SESSION['idusuario']?>"; 
    if(xid_obra=="" || xcod_act=="" || xnombre==""){
      alert("Campor Requeridos Vacios");
    }else{
      var xid = document.getElementById("id").value.trim();
      if(xid==""){
        //codigo para agregar
        $.ajax({
          type:"POST",
          url: "<?php echo URL;?>Actividad/add",
          data:{id_obra:xid_obra,cod_act:xcod_act,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }else{
        //codigo para actualizar
        $.ajax({
          type:"POST",
          url: "<?php echo URL;?>Actividad/update",
          data:{id:xid,id_obra:xid_obra,cod_act:xcod_act,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }
    }//evaluacion de campos requeridos
  }


  $(document).ready(function(){
                $("#tablaActividad").DataTable({
                    "order": [[0,"asc"],[1,"asc"],[2,"asc"],[3,"asc"]],
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