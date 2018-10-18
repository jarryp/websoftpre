<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Especifica y sub-Especifica <small>Registro de créditos presupuestarios</small>
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
       	<table class="display" id="tablaEspecifica">
       	 <thead>
         <tr>
          <th>CODIGO</th>
          <th>DENOMINACION</th>
          <th>PRESUPUESTADO</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
              $json= file_get_contents(URL."Especifica/listado?id_periodo=".$_SESSION['id_periodo']);
                      if($json!=NULL){
                      $datos = json_decode($json);
                      foreach($datos as $especifica){
                        echo "<tr>
                            <td> ". $especifica->cod_especifica."</td>
                            <td> ". $especifica->nombre ."</td>
                            <td align='right'> ". number_format($especifica->montoi,2,'.',',') ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($especifica->id_especifica)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($especifica->id_especifica)'>Elimiar</button></td>
                              </tr>";
                      }
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Añadir Cuenta Presupuestaria</h4>
            </div>
        <div class="modal-body">
            <form role="form">

                <div class="form-group">
                  <label>Actividad:</label>
                  <select id="cmbActividad" class="form-control" onchange="cargarCmbPartida()">
                    <option value="S">-- Selecciones --</option>
                <?php
                  $json  = file_get_contents(URL."Actividad/listado?id_periodo=".$_SESSION['id_periodo']);
                  if($json!=NULL){
                  $datos = json_decode($json);
                      foreach($datos as $act){
                        echo "<option value='$act->id_actividad'>$act->cod_sector.$act->cod_programa.$act->cod_obra.$act->cod_actividad -*- $act->nombre</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Partida:</label>
                  <select id="cmbPartida" class="form-control" onchange="cargarCmbGenerica()">
                    <option value="S">-- Seleccione --</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Generica:</label>
                  <select id="cmbGenerica" class="form-control" onchange="concatenarCodigo()">
                    <option value="S">-- Seleccione --</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input type="text" name="cod_especifica" id="cod_especifica" placeholder="Código de Especifica" class="form-control" maxlength="35">
               </div>
               <div class="form-group">
                 <input type="text" name="nombre" id="nombre" class="form-control" maxlength="80" placeholder="Denominación">
               </div>
               <div class="form-group">
                 <textarea rows="7" class="form-control" id="descripcion" name="descripcion" maxlength="500" placeholder="Descripción"></textarea>
               </div>
               <div class="form-group">
                 <input type="text" name="montoi" id="montoi" placeholder="Monto Ejemplo: 120000.10" class="form-control">
               </div>
               <div class="form-group">
                <label>Fuente de Financiamiento:</label>
                 <select id="cmbFuentef" name="cmbFuentef" class="form-control">
                   <option value="S">-- Seleccione --</option>
                 </select>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_especifica()">Guardar</button>
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


<script type="text/javascript">

function verventanamodal(){
  $("#ventana").modal("show");
}

function verventanamodalEditar(xid){
  var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Especifica/consulta2",
    data:{id:xid},
    success:function(response){
      var xdato = response.split("#");
      if(xdato[0].trim()=="A"){

        document.getElementById("cmbActividad").value   = xdato[6];
        cargarCmbPartida();
        $.ajax({
          type:"POST",
          url:"<?php echo URL;?>Generica/consulta2",
          data:{id:xdato[7]},
          success:function(response){
            var xvgen = response.split("#");
            document.getElementById("cmbPartida").value = xvgen[5];
            cargarCmbGenerica();
          }
        });
        
        document.getElementById("id").value  = xdato[1];
        document.getElementById("cod_especifica").value = xdato[2].trim();
        document.getElementById("nombre").value         = xdato[3].trim();
        document.getElementById("descripcion").value    = xdato[4].trim();
        document.getElementById("montoi").value         = xdato[5];
        alert("Cargando Datos...");
        document.getElementById("cmbGenerica").value    = xdato[7].trim();
        document.getElementById("cmbFuentef").value     = xdato[8];
          var xid_act      = document.getElementById("cmbActividad").value;
          var xid_partida  = document.getElementById("cmbPartida").value;
          var xid_generica = document.getElementById("cmbGenerica").value;
          $.ajax({
            type:"POST",
            url:"<?php echo URL;?>Generica/concatenarCodigo",
            data:{id_actividad:xid_act,id_partida:xid_partida,id_generica:xid_generica},
            success:function(response){

            xdato2 = response.split("#");
                if(xdato2[0]=="A"){
                var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
                  $.ajax({
                    type:"POST",
                    url:"<?php echo URL;?>Especifica/muestraNombres",
                    data:{ codigo:xdato[2].trim(),id_periodo:xid_periodo },
                    success:function(response){
                      $("#area_mensaje").html(response);;
                    }
                  });
                    
                    document.getElementById("cod_especifica").focus();
                  }else{
                    document.getElementById("cod_especifica").value = "";
                  }
    
                }
          });

      }
    }
  });
  $("#ventana").modal("show");
}

function cargarCmbPartida(){
  var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Partida/cargarCmb",
    data:{id_periodo:xid_periodo},
    success:function(response){
     $("#cmbPartida").html(response);
    }
  });
}

function cargarCmbGenerica(){
  var xid_partida  = document.getElementById("cmbPartida").value;
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Generica/cargarCmb",
    data:{id_partida:xid_partida},
    success:function(response){
     $("#cmbGenerica").html(response);
    }
  });
}

function cargarFuenteFinan(){
  var xid_entidad  = "<?php echo $_SESSION['id_entidad']?>";
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Fuentefinan/cargarCmb",
    data:{id_entidad:xid_entidad},
    success:function(response){
     $("#cmbFuentef").html(response);
    }
  });
}

function concatenarCodigo(){
 if(document.getElementById("cod_especifica").value.trim()==""){
  var xid_act      = document.getElementById("cmbActividad").value;
  var xid_partida  = document.getElementById("cmbPartida").value;
  var xid_generica = document.getElementById("cmbGenerica").value;
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Generica/concatenarCodigo",
    data:{id_actividad:xid_act,id_partida:xid_partida,id_generica:xid_generica},
    success:function(response){

      xdato = response.split("#");
      if(xdato[0]=="A"){
        var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
        $.ajax({
          type:"POST",
          url:"<?php echo URL;?>Especifica/muestraNombres",
          data:{ codigo:xdato[1].trim(),id_periodo:xid_periodo },
          success:function(response){
            $("#area_mensaje").html(response);;
          }
        });
        document.getElementById("cod_especifica").value = xdato[1].trim();
        document.getElementById("cod_especifica").focus();
      }else{
        document.getElementById("cod_especifica").value = "";
      }
    
    }
  });
 }
}

function consulta(){
  var xcod_especifica = document.getElementById("cod_especifica").value.trim();
  var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Especifica/consulta",
    data:{id_periodo:xid_periodo,cod_especifica:xcod_especifica},
    success:function(response){
      alert(response);
      var xdato = response.split("#");
      if(xdato[0]=="A"){
        document.getElementById("id_especifica").value = xdato[1];
        document.getElementById("nombre").value        = xdato[3].trim();
        document.getElementById("descripcion").value   = xdato[4].trim();
        document.getElementById("montoi").value        = xdato[5];
        document.getElementById("cmbFuentef").value    = xdato[6];
      }
    }
  });
}


function envia_especifica(){
  var xid_usuario     = "<?php echo $_SESSION['idusuario']?>";
  var xid_periodo     = "<?php echo $_SESSION['id_periodo']?>";
  var xcod_especifica = document.getElementById("cod_especifica").value.trim();
  var xnombre         = document.getElementById("nombre").value.trim();
  var xdescripcion    = document.getElementById("descripcion").value.trim();
  var xmontoi         = document.getElementById("montoi").value;
  var xid_actividad   = document.getElementById("cmbActividad").value;
  var xid_generica    = document.getElementById("cmbGenerica").value;
  var xid_fuentefinan = document.getElementById("cmbFuentef").value;
  if( xcod_especifica == "" || xnombre == "" || xid_fuentefinan == "" ){
    alert("Campos Requeridos Vacios");
  }else{
    var xid = document.getElementById("id").value;
    if(xid==""){
      //agregar
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Especifica/add",
        data:{cod_especifica:xcod_especifica,nombre:xnombre,descripcion:xdescripcion,montoi:xmontoi,id_periodo:xid_periodo,idusuario:xid_usuario,id_actividad:xid_actividad,id_generica:xid_generica,id_fuentefinan:xid_fuentefinan},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }else{
      //modificar
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Especifica/update",
        data:{id:xid,cod_especifica:xcod_especifica,nombre:xnombre,descripcion:xdescripcion,montoi:xmontoi,idusuario:xid_usuario,id_fuentefinan:xid_fuentefinan},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }
  } 
}

$(document).ready(function(){
                $("#tablaEspecifica").DataTable({
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

                cargarFuenteFinan();


            });

</script>