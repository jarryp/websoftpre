<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Generica <small>sub clasificación de partidas</small>
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
       	<table class="display" id="tablagGenerica">
       	 <thead>
         <tr>
          <th width="10%">COD_PAR</th>
          <th width="10%">CODIGO</th>
          <th>DESCRIPCION</th>
          <th width="10%">EDITAR</th>
          <th width="10%">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Generica/listado?id_periodo=".$_SESSION['id_periodo']);
                      $datos = json_decode($json);
                      foreach($datos as $generica){
                        echo "<tr>
                            <td> ". $generica->cod_partida."</td>
                            <td> ". $generica->cod_generica."</td>
                            <td> ". $generica->nombre ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($generica->id_generica)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($generica->id_generica)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Genericas</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select id="cmbPartida" class="form-control">
                    <option value="S">-- Seleccione --</option>
                <?php
                 $json  = file_get_contents(URL."Partida/listado?id_periodo=".$_SESSION['id_periodo']);
                 $datos = json_decode($json);
                   foreach($datos as $partida){
                    echo "<option value='$partida->id_partida'>$partida->cod_partida -*- $partida->nombre</option>";
                   }
                ?>
                  </select>
               </div>
               <div class="form-group">
                 <input type="text" name="cod_generica" id="cod_generica" maxlength="2" placeholder="Código de la Generica" class="form-control" onblur="consulta()">
               </div>
               <div class="form-group">
                 <input type="text" name="nombre" id="nombre" placeholder="Denominación" maxlength="80" class="form-control">
               </div>
               <div class="form-group">
                 <textarea id="descripcion" name="descripcion" rows="6" class="form-control"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_generica()">Guardar</button>
             </form>
             <div class="form-group">
               <div id="area_mensaje"></div>
             </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>


<script>

function verventanamodal(){
    document.getElementById("id").value="";
    document.getElementById("cmbPartida").value="S";
    document.getElementById("cod_generica").value="";
    document.getElementById("nombre").value="";
    document.getElementById("descripcion").value="";
    $("#ventana").modal("show");
    document.getElementById("cmbPartida").focus();
}

function verventanamodalEditar(xid){
  $("#ventana").modal("show");
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Generica/consulta2",
    data:{id:xid},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0].trim()=="A"){
        document.getElementById("id").value           = xdato[1];
        document.getElementById("cmbPartida").value   = xdato[5];
        document.getElementById("cod_generica").value = xdato[2];
        document.getElementById("nombre").value       = xdato[3].trim();
        document.getElementById("descripcion").value  = xdato[4].trim();
      }
    }
  });
}

function consulta(){
  var xid_partida  = document.getElementById("cmbPartida").value;
  var xcod_generica = document.getElementById("cod_generica").value;
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Generica/consulta",
    data:{id_partida:xid_partida,cod_generica:xcod_generica},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0].trim()=="A"){
        document.getElementById("id").value          = xdato[1];
        document.getElementById("nombre").value      = xdato[3].trim();
        document.getElementById("descripcion").value = xdato[4].trim();
      }
    }
  });
}

function envia_generica(){
  var xid_usuario   = "<?php echo $_SESSION['idusuario']?>";
  var xid_partida   = document.getElementById("cmbPartida").value;
  var xcod_generica = document.getElementById("cod_generica").value.trim();
  var xnombre       = document.getElementById("nombre").value.trim();
  var xdescripcion  = document.getElementById("descripcion").value.trim();
  if(xid_partida=="" || xcod_generica=="" || xnombre==""){
    alert("Campos requeridos Vacios");
  }else{
    var xid = document.getElementById("id").value;
    if(xid==""){
      //agregar
      $.ajax({
        type:"POST",
        url: "<?php echo URL;?>Generica/add",
        data:{id_partida:xid_partida,cod_generica:xcod_generica,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }else{
      //modificar
      $.ajax({
        type:"POST",
        url: "<?php echo URL;?>Generica/update",
        data:{id:xid,id_partida:xid_partida,cod_generica:xcod_generica,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }//fin de MDL
  }//fin validacion de inserción de datos en campos requeridos
}


 $(document).ready(function(){
                $("#tablagGenerica").DataTable({
                    "order": [[0, "asc"],[1, "asc"]],
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