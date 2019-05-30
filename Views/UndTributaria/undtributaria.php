<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Unidad Tributaria <small>Registro y actualización del valor de la unidad tributaria</small>
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
       	<table class="display" id="tablaUndTributaria">
       	 <thead>
         <tr>
          <th>DENOMINACION</th>
          <th>VALOR</th>
          <th>FECHA</th>
          <th>DESCRIPCION</th>
          <th width="10%" align="center">EDITAR</th>
          <th width="10%" align="center">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."UndTributaria/listado");
                      $datos = json_decode($json);
                      foreach($datos as $ut){
                        echo "<tr>
                            <td> ". $ut->denominacion ."</td>
                            <td> ". $ut->valor ."</td>
                            <td> ". $ut->fechav ."</td>
                            <td> ". $ut->descripcion ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($ut->id)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($ut->id)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Actualizar Valor de la Unidad Tributaria</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="denominacion" name="denominacion" maxlength="80" placeholder="Denominación">
                  <input class="form-control" type="text" id="valor" name="valor" maxlength="80" placeholder="Valor: 0.00">
                  <input class="form-control" type="date" id="fechav" name="fechav" placeholder="Fecha Vigencia" />
                  <input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="100" placeholder="Descripcion">
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_undtributaria()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        <div class="row" id="area_mensaje"></div>
        </div>
    </div>
</div>


<script>
   $(document).ready(function(){
                $("#tablaUndTributaria").DataTable({
                    "order": [[2, "desc"]],
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
        $("#denominacion").val("");
        $("#valor").val("");
        $("#fechav").val("");
        $("#descripcion").val("");
        $("#area_mensaje").html("");
        $("#ventana").modal("show");
        document.getElementById("denominacion").focus();
    }

    function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>UndTributaria/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                  $("#id").val(xdata[1]);
                  $("#denominacion").val(xdata[2].trim());
                  $("#valor").val(xdata[3]);
                  $("#fechav").val(xdata[4]);
                  $("#descripcion").val(xdata[5].trim());
                  $("#area_mensaje").html("");
                  $("#ventana").modal("show");
                  $("#denominacion").focus();                                  
                }else{
                    alert("Error de Consulta");
                }
              }
           });              
     }

  function envia_undtributaria(){
              //var xid_entidad   = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario   = "<?php echo $_SESSION['idusuario']?>";
              var xdescripcion  = $("#descripcion").val().trim();
              var xdenominacion = $("#denominacion").val().trim();
              var xvalor        = $("#valor").val();
              var xfechav       = $("#fechav").val();
              if( xid_usuario=="" || xdescripcion=="" || xdenominacion=="" ){
                alert("Campos Requeridos Vacios");
              }else{

                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>UndTributaria/add",
                  data:{denominacion:xdenominacion,id_usuario:xid_usuario,descripcion:xdescripcion,
                  valor:xvalor,fechav:xfechav},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }else{
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>UndTributaria/update",
                  data:{id:xid,denominacion:xdenominacion,id_usuario:xid_usuario,
                        descripcion:xdescripcion,valor:xvalor,fechav:xfechav},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }
              } 
            }

</script>