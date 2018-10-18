<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Partida <small> Registro de partidas según ONAPRE</small>
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
       	<table class="display" id="tablaPartida">
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
                      $json= file_get_contents(URL."Partida/listado?id_periodo=".$_SESSION['id_periodo']);
                      $datos = json_decode($json);
                      foreach($datos as $partida){
                        echo "<tr>
                            <td> ". $partida->cod_partida."</td>
                            <td> ". $partida->nombre."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($partida->id_partida)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($partida->id_partida)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Partida</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="cod_partida" name="cod_partida" maxlength="4" placeholder="Código de la Partida" onblur="consulta()">
               </div>
               <div class="form-group">
                 <input type="text" name="nombre" id="nombre" maxlength="80" placeholder="Denominación" class="form-control">
               </div>
               <div class="form-group">
                 <textarea id="descripcion" name="descripcion" rows="7" class="form-control" placeholder="Descripción" maxlength="400"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_partida()">Guardar</button>
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
    document.getElementById("cod_partida").value="";
    document.getElementById("nombre").value="";
    document.getElementById("descripcion").value="";
    $("#ventana").modal("show");
    document.getElementById("cod_partida").focus();
    
  }

  function verventanamodalEditar(xid){
    
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Partida/consulta2",
        data:{id:xid},
        success:function(response){
          xdato = response.split("#");
          if(xdato[0].trim()=="A"){
            document.getElementById("id").value          = xdato[1];
            document.getElementById("nombre").value      = xdato[2];
            document.getElementById("descripcion").value = xdato[3];
            document.getElementById("cod_partida").value = xdato[4];
            $("#ventana").modal("show");
            document.getElementById("cod_partida").focus();
          }
        }
      });
  }

  function consulta(){
    var xcod_par    = document.getElementById("cod_partida").value.trim();
    var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
    if(xcod_par!="" && xid_periodo!=""){
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Partida/consulta",
        data:{cod_partida:xcod_par,id_periodo:xid_periodo},
        success:function(response){
          xdato = response.split("#");
          if(xdato[0].trim()=="A"){
            document.getElementById("id").value          = xdato[1];
            document.getElementById("nombre").value      = xdato[2];
            document.getElementById("descripcion").value = xdato[3];
          }
        }
      });
    }
  }


  function envia_partida(){
    var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>";
    var xid_usuario  = "<?php echo $_SESSION['idusuario']?>";
    var xcod_par     = document.getElementById("cod_partida").value.trim();
    var xnombre      = document.getElementById("nombre").value.trim();
    var xdescripcion = document.getElementById("descripcion").value.trim();
    if(xcod_par=="" || xnombre==""){
      alert("Campos Requeridos Vacios!");
    }else{
      var xid = document.getElementById("id").value;
      if(xid==""){
        //código para insertar registro
        $.ajax({
          type:"GET",
          url: "<?php echo URL;?>Partida/add",
          data:{cod_partida:xcod_par,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario,id_periodo:xid_periodo},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }else{
        //código para actualizar
        $.ajax({
          type:"POST",
          url: "<?php echo URL;?>Partida/update",
          data:{id:xid,cod_partida:xcod_par,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario,id_periodo:xid_periodo},
          success:function(response){
            $("#area_mensaje").html(response);
          }
        });
      }//fin de evaluacion de nuevo registro o actualizacion
    }//fin de delocontrario de evaluacion de campos requeridos  
  }// fin de la función


  $(document).ready(function(){
                $("#tablaPartida").DataTable({
                    "order": [[0, "asc"]],
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