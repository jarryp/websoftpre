<div id="page-wrapper">
    <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Estados de Cuenta <small>Registro de saldos finales según Edocuentas para elaboración de conciliación bancaria</small>
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
       	<table class="display" id="tablaEdocuenta">
       	 <thead>
         <tr>
          <th>BANCO</th>
          <th>NUMERO DE CUENTA</th>
          <th>AÑO</th>
          <th>MES</th>
          <th>SALDO</th>
          <th width="10%">EDITAR</th>
          <th width="10%">ELIMINAR</th>
         </tr>
         </thead>
         <tbody>
             <?php
                      $json= file_get_contents(URL."Edocuenta/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $edocuenta){
                        echo "<tr>
                            <td> ". $edocuenta->banco."</td>
                            <td> ". $edocuenta->num_cuenta ."</td>
                            <td> ". $edocuenta->agno ."</td>
                            <td> ". $edocuenta->nom_mes ."</td>
                            <td align='right'> ". number_format($edocuenta->saldo,2,'.',',') ."</td>
                            <td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($edocuenta->id_edocuenta)'>Editar</button> </td>
                            <td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($edocuenta->id_edocuenta)'>Elimiar</button></td>
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
                <h4 class="modal-title" id="myModalLabel">Añadir/Editar Registro de Estados de Cuentas Bancarias</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" />
                  <select name="cmbCuentab" class="form-control" id="cmbCuentab">
                    <option value="S">  -- Seleccione Cuenta Bancaria -- </option>
                    <?php 
                      $json  = file_get_contents(URL."Cuentab/listado?id_entidad=".$_SESSION['id_entidad']);
                      $datos = json_decode($json);
                      foreach($datos as $cuentab){
                        echo "<option value='$cuentab->id_cuentab'>$cuentab->banco -*- $cuentab->num_cuenta</option>";
                      }
                    ?>
                  </select>
                  <select name="cmbAgno" class="form-control" id="cmbAgno">
                    <option value="S">  -- Seleccione Año -- </option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                  </select>
                  <select name="cmbMes" class="form-control" id="cmbMes">
                    <option value="S">  -- Seleccione Mes -- </option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>
                  <input type="text" name="saldo" id="saldo" class="form-control">
               </div>

                  <button type="button"
                          class="btn btn-primary"
                          onclick="javascript:envia_edocuenta()">Guardar</button>
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
                $("#tablaEdocuenta").DataTable({
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
      $("#cmbCuentab").val("S");
      $("#cmbAgno").val("S");
      $("#cmbMes").val("S");
      $("#Saldo").val("");
      $("#area_mensaje").html("");
      $("#ventana").modal("show");
      $("#cmbBanco").focus();
   }


   function envia_edocuenta(){
        if($("#cuentab").val()!="S" &&  $("#cmbAgno").val()!="S" && $("#cmbMes").val()!="S" && $("#saldo").val()!="" ){
          var xid_usuario   = "<?php echo $_SESSION['idusuario']?>";
          var xcuentab      = $("#cmbCuentab").val();
          var xagno         = $("#cmbAgno").val();
          var xmes          = $("#cmbMes").val();
          var xsaldo        = $("#saldo").val();
          var xid           = $("#id").val();
           if(xid==""){
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Edocuenta/add",
                  data:{id_usuario:xid_usuario,
                        id_cuentab:xcuentab,
                        agno:xagno,
                        mes:xmes,
                        saldo:xsaldo},
                  success:function(response){
                      $("#area_mensaje").html(response);
                  }

                });
           }else{
               $.ajax({
                  type:"POST",
                  url:"<?php echo URL;?>Edocuenta/update",
                  data:{id:xid,
                        id_usuario:xid_usuario,
                        id_cuentab:xcuentab,
                        agno:xagno,
                        mes:xmes,
                        saldo:xsaldo},
                  success:function(response){
                    $("#area_mensaje").html(response);
                  }
                });
           }
        }else{
          alert("Campos Requeridos Vacios");   
        }
    }


</script>