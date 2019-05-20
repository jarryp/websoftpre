<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Cuentas Bancarias <small>Registro principal cuentas bancarias</small>
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
       	<table class="display" id="tablaCuentab">
       	 <thead>
         <tr>
          <th>TIPO</th>
          <th>BANCO</th>
          <th>NUMERO DE CUENTA</th>
          <th>DESCRIPCION</th>
          <th width="10%">EDITAR</th>
          <th width="10%">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json  = file_get_contents(URL."Cuentab/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $cuentab){
                        echo "<tr>
                            <td> ". $cuentab->uso_cuenta."</td>
                            <td> ". $cuentab->banco."</td>
                            <td> ". $cuentab->num_cuenta."</td>
                            <td> ". $cuentab->descripcion ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($cuentab->id_cuentab)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($cuentab->id_cuentab)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Actualizar Registro de Cuentas Bancarias</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select name="cmbUsoCuenta" id="cmbUsoCuenta" class="form-control">
                    <option value="S">  --  Seleccione tipo de uso de la cuenta --</option>
                    <option value="1">Situado Constitucional</option>
                    <option value="2">Situado Coordinado</option>
                    <option value="3">Ingresos Propios</option>
                    <option value="4">Fondos Especiales</option>
                    <option value="5">Fondos de Terceros</option>
                  </select>
                  <select id="cmbBanco" name="cmbBanco" class="form-control">
                     <option value="S"> -- Seleccione Banco-- </option>
                     <?php 
                          $json= file_get_contents(URL."Banco/listado");
                          $datos = json_decode($json);
                           foreach($datos as $banco){
                             echo "<option value='$banco->id_banco'>$banco->nombre</opcion>";
                           }
                      ?>
                  </select>

                 <input type="text" name="num_cuenta" id="num_cuenta" maxlength="25" class="form-control" placeholder="Número de Cuenta / formato: 0134-0038-5103-0000-0001">
                 <input type="text" name="saldo_inicial" id="saldo_inicial" class="form-control" placeholder="Saldo Inicial de la Cuenta Según Libros">
                  <textarea class="form-control" rows="4" cols="60" placeholder="Breve descripción del uso de la cuenta" name="descripcion" id="descripcion"></textarea>
               </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_cuentab()">Guardar</button>
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
  
     $(document).ready(function(){
                $("#tablaCuentab").DataTable({
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
      $("#cmbUsoCuenta").val("S");
      $("#cmbBanco").val("S");
      $("#num_cuenta").val("");
      $("#descripcion").val("");
      $("#saldo_inicial").val("");
      $("#area_mensaje").html("");
      $("#ventana").modal("show");
      document.getElementById("cmbUsoCuenta").focus();
   }

   function verventanamodalEditar(id){
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>Cuentab/consulta",
            data:{id:id},
            success:function(response){
                var xdata = response.split("#");
                if(xdata[0]=="A"){
                            $("#id").val(xdata[1].trim());    
                            $("#cmbUsoCuenta").val(xdata[2]);  
                            $("#cmbBanco").val(xdata[3]);
                            $("#num_cuenta").val(xdata[4]);
                            $("#saldo_inicial").val(xdata[5]);
                            $("#descripcion").val(xdata[6]);
                            $("#area_mensaje").html("");
                            $("#ventana").modal("show");                                        
                }else{
                  alert("Error de Consulta");
                }
             }
          });            
    }



   function envia_cuentab(){
        if($("#cmbUsoCuenta").val().trim()!="S" && $("#cmbBanco").val().trim()!="S" && $("#num_cuenta").val().trim()!="" &&  $("#descripcion").val().trim()!="" && $("#saldo_inicial").val().trim()!="" ){
          var xid_entidad    = "<?php echo $_SESSION['id_entidad']?>";
          var xid_usuario    = "<?php echo $_SESSION['idusuario']?>";
          var xid_banco      = $("#cmbBanco").val().trim();
          var xuso_cuenta    = $("#cmbUsoCuenta").val().trim();
          var xnum_cuenta    = $("#num_cuenta").val().trim();
          var xdescripcion   = $("#descripcion").val().trim();
          var xsaldo_inicial = $("#saldo_inicial").val().trim();
          var xid            = $("#id").val().trim();
           if(xid==""){
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Cuentab/add",
                  data:{id_usuario:xid_usuario,
                        id_banco:xid_banco,
                        uso_cuenta:xuso_cuenta,
                        num_cuenta:xnum_cuenta,
                        descripcion:xdescripcion,
                        saldo_inicial:xsaldo_inicial},
                  success:function(response){
                      $("#area_mensaje").html(response);
                  }

                });
           }else{
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Cuentab/update",
                  data:{id:xid,
                        id_usuario:xid_usuario,
                        id_banco:xid_banco,
                        uso_cuenta:xuso_cuenta,
                        num_cuenta:xnum_cuenta,
                        descripcion:xdescripcion,
                        saldo_inicial:xsaldo_inicial},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
           }
        }else{
          alert("Datos requeridos incompletos!");   
        }
    }


</script>