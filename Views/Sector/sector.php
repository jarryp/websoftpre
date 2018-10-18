<div id="page-wrapper">
    <div id="page-inner">

    	   	      <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Sectores
      <small>1er. Nivel de Clasificación Presupuestaria</small> 
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
       	<table class="display" id="tablaSector">
       	 <thead>
         <tr>
          <th>CODIGO</th>
          <th>NOMBRE</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php

                      $json = file_get_contents(URL."Sector/listado?id_periodo=".$_SESSION['id_periodo']);
                      $datos = json_decode($json);

                      foreach($datos as $lsector){
                        echo "<tr>
                            <td> ". $lsector->cod_sector."</td>
                            <td> ". $lsector->nombre ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($lsector->id_sector)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($lsector->id_sector)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir Sector</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">

                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="cod_sector" name="cod_sector" maxlength="2" placeholder="Código" onblur="consulta()">

               </div>
               <div class="form-group">
                  <input class="form-control" type="text" id="nombre" name="nombre" maxlength="80" placeholder="Denominación">
               </div>
               <div class="form-group">
                  <textarea id="descripcion" placeholder="Descripción" rows="6" class="form-control"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_sector()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <div id="area_mensaje"></div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>

 <script>

 



 function envia_sector(){
  var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>";
  var xid_usuario  = "<?php echo $_SESSION['idusuario']?>";
  var xid          = document.getElementById("id").value.trim() ;
  var xcod_sector  = document.getElementById("cod_sector").value.trim();
  var xnombre      = document.getElementById("nombre").value.trim();
  var xdescripcion = document.getElementById("descripcion").value.trim();

  if(xcod_sector == "" || xnombre == ""){
    alert("Campos Requeridos Vacios");
  }else{
    
    if(xid==""){
      //agregar datos
      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Sector/add",
        data:{id_periodo:xid_periodo,cod_sector:xcod_sector,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });
    }else{
      //modificar datos

      $.ajax({
        type:"POST",
        url:"<?php echo URL;?>Sector/update",
        data:{id:xid,id_periodo:xid_periodo,cod_sector:xcod_sector,nombre:xnombre,descripcion:xdescripcion,idusuario:xid_usuario},
        success:function(response){
          $("#area_mensaje").html(response);
        }
      });


    }

  }//fin de - de lo contrario de evaluacion de ingreso de datos campos requeridos


 }


 function consulta(){
  var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
  var xcod_sector = document.getElementById("cod_sector").value.trim();
  $.ajax({
    type:"GET",
    url:"<?php echo URL;?>Sector/consulta",
    data:{id_periodo:xid_periodo,cod_sector:xcod_sector},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0]=="A"){
      document.getElementById("id").value          = xdato[3];
      document.getElementById("nombre").value      = xdato[1];
      document.getElementById("descripcion").value = xdato[2];
      }
    }
  });
}

 function verventanamodal(){
  $("#area_mensaje").html("");
  document.getElementById("id").value="";
  document.getElementById("cod_sector").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("descripcion").value = "";
  $("#ventana").modal("show");
  document.getElementById("cod_sector").focus();
}

function verventanamodalEditar(id_sector){
  $("#area_mensaje").html("");
  document.getElementById("id").value = id_sector;
  $.ajax({
    type:"POST",
    url:"<?php echo URL;?>Sector/consulta2",
    data:{id_sector:id_sector},
    success:function(response){
      xdato = response.split("#");
      if(xdato[0]=="A"){
      document.getElementById("cod_sector").value  = xdato[1];
      document.getElementById("nombre").value      = xdato[2];
      document.getElementById("descripcion").value = xdato[3];
      }
    }
  });

  $("#ventana").modal("show");
  document.getElementById("nombre").focus();              
}

            $(document).ready(function(){
                $("#tablaSector").DataTable({
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