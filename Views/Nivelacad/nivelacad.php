<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Nivel Academico <small></small>
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
       	<table class="display" id="tablaNivel_a">
       	 <thead>
         <tr>
          <th>NIVEL ACADEMICO</th>
          <th width="10%" align="center">FORMULA</th>
          <th width="10%" align="center">EDITAR</th>
          <th width="10%" align="center">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Nivelacad/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $nivela){
                        echo "<tr>
                            <td>$nivela->descripcion</td>
                            <td align='right'>$nivela->formula</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($nivela->id_nivel_academico)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($nivela->id_nivel_academico)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Editar Nivel Academico</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <input class="form-control" type="text" id="descripcion" name="descripcion" maxlength="100" placeholder="Descripcion">
                  <input type="text" name="formula" id="formula" placeholder="Formula de asignación" class="form-control">
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_nivelacad()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        <div class="row" id="area_mensaje"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
  
 $(document).ready(function(){
                $("#tablaNivel_a").DataTable({
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

 function verventanamodal(){
        $("#descripcion").val("");
        $("#formula").val("");
        $("#area_mensaje").html("");
        $("#ventana").modal("show");
        $("#descripcion").focus();
}

  function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>Nivelacad/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                  $("#id").val(xdata[1]);
                  $("#descripcion").val(xdata[2].trim());
                  $("#formula").val(xdata[3]);
                  $("#area_mensaje").html("");
                  $("#ventana").modal("show");
                  $("#descripcion").focus();                                  
                }else{
                    alert("Error de Consulta");
                }
              }
           }); 
  }             


function envia_nivelacad(){
              var xid_entidad  = "<?php echo $_SESSION['id_entidad']?>";
              var xid_usuario  = "<?php echo $_SESSION['idusuario']?>";
              var xdescripcion = $("#descripcion").val().trim();
              var xformula     = $("#formula").val();  

              if(xid_entidad=="" || xid_usuario=="" || xdescripcion==""){
                alert("Campos Requeridos Vacios");
              }else{
                if(xformula==""){
                  xformula="0";
                }
                var xid = document.getElementById("id").value.trim();
                
                if(xid==""){
                
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Nivelacad/add",
                  data:{id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion,
                        formula:xformula},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }else{
                $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Nivelacad/update",
                  data:{id:xid,id_entidad:xid_entidad,id_usuario:xid_usuario,descripcion:xdescripcion,
                        formula:xformula},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
              }
              } 
            }

</script>