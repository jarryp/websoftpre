<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Soporte Legal <small>Registro de instrumentos legales que facultan al operador para modificar el presupuesto</small>
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
       	<table class="display" id="tablaSoportel">
       	 <thead>
         <tr>
          <th>FECHA</th>
          <th>CODIGO</th>
          <th>DESCRIPCION</th>
          <th>TIPO</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
              $json= file_get_contents(URL."Soportel/listado?id_periodo=".$_SESSION['id_periodo']);
              $datos = json_decode($json);
                      foreach($datos as $soportel){
                        echo "<tr>
                            <td> ". $soportel->fecha ."</td>
                            <td> ". $soportel->cod_soportel."</td>
                            <td> ". $soportel->descripcion."</td>
                            <td> ". $soportel->tipo ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($soportel->id_soportel)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($soportel->id_soportel)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Soporte Legal <small> para modificaciones presupuestarias</small></h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                 <input type="hidden" name="id" id="id" />
                 <input type="text" name="cod_soportel" id="cod_soportel" maxlength="20" placeholder="Código" class="form-control" onblur="consulta()">
               </div>
                <div class="form-group">
                  <input type="date" id="fecha" name="fecha" placeholder="YYYY-MM-DD" class="form-control">
               </div>
               <div class="form-group">
                 <select id="cmbTipoModificacion" class="form-control">
                   <option value="S">-- Seleccione --</option>
                   <option value="1">Crédito Adicional</option>
                   <option value="2">Traslado</option>
                   <option value="3">Reducción</option>
                 </select>
               </div>
               <div class="form-group">
                 <textarea id="descripcion" name="descripcion" class="form-control" rows="6" placeholder="Descripción"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_soportel()">Guardar</button>
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
  
 
   $(document).ready(function(){
                $("#tablaSoportel").DataTable({
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
 
 function verventanamodal(){
  document.getElementById("id").value                  = "";
  document.getElementById("cod_soportel").value        = "";
  document.getElementById("fecha").value               = "";
  document.getElementById("cmbTipoModificacion").value = "S";
  document.getElementById("descripcion").value         = "";
  $("#ventana").modal("show");
  document.getElementById("cod_soportel").focus();
 }

 function verventanamodalEditar(xid){
  consulta2(xid);
  $("#ventana").modal("show");
  document.getElementById("cod_soportel").focus();
 }

 function consulta(){
  var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>"; 
  $.ajax({
    type:"GET",
    url:"<?php echo URL;?>Soportel/consulta",
    data:{cod_soportel:document.getElementById("cod_soportel").value,
          id_periodo:xid_periodo},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0].trim()=="A"){
        document.getElementById("id").value                  = xdato[1];
        document.getElementById("fecha").value               = xdato[3];
        document.getElementById("cmbTipoModificacion").value = xdato[4];
        document.getElementById("descripcion").value         = xdato[5].trim();
      }
    }
  });
 }

  function consulta2(xid){
  $.ajax({
    type:"GET",
    url:"<?php echo URL;?>Soportel/consulta2",
    data:{id:xid},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0].trim()=="A"){
        document.getElementById("id").value                  = xdato[1];
        document.getElementById("cod_soportel").value        = xdato[2].trim();
        document.getElementById("fecha").value               = xdato[3];
        document.getElementById("cmbTipoModificacion").value = xdato[4];
        document.getElementById("descripcion").value         = xdato[5].trim();
      }
    }
  });
 }


 
 
 function envia_soportel(){
  var xid_usuario      = "<?php echo $_SESSION['idusuario']?>";
  var xid_periodo      = "<?php echo $_SESSION['id_periodo']?>"; 
  var xcodigo          = document.getElementById("cod_soportel").value.trim();
  var xfecha           = document.getElementById("fecha").value;
  var xid_modificacion = document.getElementById("cmbTipoModificacion").value;
  var xdescripcion     = document.getElementById("descripcion").value.trim();

  if(xid_periodo=="" || xcodigo=="" || xfecha=="" || xid_modificacion=="" || xdescripcion==""){
    alert("Campos Requeridos Vacios...");
  }else{
    var xid = document.getElementById("id").value;
    if(xid==""){
      //agregar
     $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Soportel/add",
        data:{id_periodo:xid_periodo,codigo:xcodigo,fecha:xfecha,id_modificacion:xid_modificacion,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }else{
      //modificar
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Soportel/update",
        data:{id:xid,id_periodo:xid_periodo,codigo:xcodigo,fecha:xfecha,id_modificacion:xid_modificacion,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      }); 
    }
  }

 } 



</script>