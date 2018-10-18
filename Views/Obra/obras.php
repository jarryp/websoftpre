<div id="page-wrapper">
    <div id="page-inner">

    	   	      <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Obras <small>3er. Nivel de clasificación presupuestaria </small>
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
       	<table class="display" id="tablaObra">
       	 <thead>
         <tr>
          <th>CODIGO</th>
          <th>DESCRIPCION</th>
          <th>SECTOR</th>
          <th>PROGRAMA</th>
          <th align="center">ACCIONES</th>
         </tr>
         </thead>
         <tbody>
             <?php
                $json  = file_get_contents(URL."Obra/listado?id_periodo=".$_SESSION['id_periodo']);
                $datos = json_decode($json);
                      foreach($datos as $obra){
                        echo "<tr>
                            <td> ".$obra->cod_obra."</td>
                            <td> ".$obra->obra ."</td>
                            <td> ".$obra->cod_sector." - ".$obra->sector ."</td>
                            <td> ".$obra->cod_programa." - ".$obra->programa ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($obra->id_obra)'>Editar</button>  <button class='btn btn-danger' onclick='javascript:elimina_usuario($obra->id_obra)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Obra</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select id="cmbSector" class="form-control"  onchange="cargarPrograma()">
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
                 <select id="cmbPrograma" class="form-control">
                   <option value="S">-- Seleccione --</option>
                 </select>
               </div>
               <div class="form-group">
                 <input type="text" name="cod_obra" id="cod_obra" maxlength="2" placeholder="Código de la Obra" class="form-control" onblur="consulta()">
               </div>
               <div class="form-group">
                 <input type="text" name="nombre" id="nombre" maxlength="90" class="form-control" placeholder="Denominación">
               </div>
               <div class="form-group">
                 <textarea class="form-control" rows="5" name="descripcion" id="descripcion" placeholder="Ingrese breve descripción del programa"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_obra()">Guardar</button>
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

<script type="text/javascript">

  function verventanamodal(){
    $("#area_mensaje").html("");
    document.getElementById("cmbSector").value="S";
    document.getElementById("cmbPrograma").value="S";
    document.getElementById("cod_obra").value="";
    document.getElementById("nombre").value="";
    document.getElementById("descripcion").value="";
    $("#ventana").modal("show");
    document.getElementById("cmbSector").focus();
  }

  function verventanamodalEditar(xid){
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Obra/consulta2",
      data:{id:xid},
      success:function(response){
        xdato = response.split("#");
        if(xdato[0].trim()=="A"){
          document.getElementById("cmbSector").value   = xdato[5];
          $.ajax({
              type:"POST",
              url:"<?php echo URL;?>Programa/cargarCmb",
              data:{id_sector:document.getElementById("cmbSector").value},
              success:function(response){
                $("#cmbPrograma").html(response);
                document.getElementById("cmbPrograma").value = xdato[6];
              }
            });
          document.getElementById("id").value          = xdato[1];
          document.getElementById("cod_obra").value    = xdato[2].trim();
          document.getElementById("nombre").value      = xdato[3].trim();
          document.getElementById("descripcion").value = xdato[4].trim();
        }
      }
    });
    $("#area_mensaje").html("");
    
    $("#ventana").modal("show");
    document.getElementById("cod_obra").focus();
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

  function consulta(){
    var xid_programa = document.getElementById("cmbPrograma").value;
    var xcod_obra    = document.getElementById("cod_obra").value;
    $.ajax({
      type:"POST",
      url:"<?php echo URL;?>Obra/consulta",
      data:{id_programa:xid_programa,cod_obra:xcod_obra},
      success:function(response){
        var xdato = response.split("#");
        document.getElementById("id").value          = xdato[1];
        document.getElementById("nombre").value      = xdato[2].trim();
        document.getElementById("descripcion").value = xdato[3];
      }
    });
  }


  function envia_obra(){
    var xid_programa = document.getElementById("cmbPrograma").value;
    var xcod_obra    = document.getElementById("cod_obra").value;
    var xnombre      = document.getElementById("nombre").value.trim();
    var xdescripcion = document.getElementById("descripcion").value.trim();
    var xid_usuario  = "<?php echo $_SESSION['idusuario']?>"; 

    if(xid_programa=="" || xcod_obra=="" || xnombre==""){
      alert("Campor Requeridos Vacios");
    }else{
      var xid = document.getElementById("id").value.trim();
      if(xid==""){
        //codigo para agregar
        $.ajax({
          type:"POST",
          url: "<?php echo URL;?>Obra/add",
          data:{id_programa:xid_programa,cod_obra:xcod_obra,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }else{
        //codigo para actualizar
        $.ajax({
          type:"POST",
          url: "<?php echo URL;?>Obra/update",
          data:{id:xid,id_programa:xid_programa,cod_obra:xcod_obra,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }
    }//fin else de validación de ingreso de datos
  }

  $(document).ready(function(){
                $("#tablaObra").DataTable({
                    "order": [[2,"asc"],[3,"asc"],[0,"asc"]],
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