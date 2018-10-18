<div id="page-wrapper">
 <div id="page-inner">
    <!-- ROW  -->
 <div class="row">
  <div class="col-md-12">
    <h1 class="page-header">
      Periodos Presupuestarios <small>Registro de periodos de contro presupuestaria para el ejercicio economico en curso</small>
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
       	<table class="display" id="tablaPeriodop">
       	 <thead>
         <tr>
          <th>Código</th>
          <th>Denominación</th>
          <th>Descripción</th>
          <th>Editar</th>
          <th>Eliminar</th>
         </tr>
         </thead>
         <tbody>
            <?php 
              $json= file_get_contents(URL."Periodop/listado?id_entidad=".$_SESSION['id_entidad']);
              $datos = json_decode($json);
              foreach($datos as $lperiodo){
                echo "<tr>
                        <td>$lperiodo->id_periodo</td>
                        <td align='center'>$lperiodo->descripcion</td>
                        <td>$lperiodo->observaciones</td>
                        <td align='center'> <button class='btn btn-success'>Editar</button> </td>
                        <td align='center'> <button class='btn btn-danger'>Eliminar</button> </td>
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


<script>
            $(document).ready(function(){
                $("#tablaPeriodop").DataTable({
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
</script>