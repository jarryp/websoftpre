<div id="page-wrapper">
 <div id="page-inner">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-primary">
     <div class="panel-heading">
     	Usuario:<strong> <?php echo $_SESSION['n_usuario']; ?> | 
    	Procesamiento y Consulta de Ordenes de Compra </strong>
     </div>
     <div class="panel-body">
      <form name="formOcompra" id="formOcompra">
       
       <div class="form-group col-md-12">
       	<div class="col-md-1"><label>Código</label></div>
     	<div class="col-md-2">
     		<div class="input-group">
      				<input type="text" class="form-control" id="id" name="id">
      				<span class="input-group-btn">
        				<button class="btn btn-success" type="button" >**</button>
      				</span>
    			</div>
     	</div>
     	<div class="col-md-1"><label>Fecha</label></div>
     	<div class="col-md-2">
     		<input type="date" name="fecha" id="fecha" maxlength="10" placeholder="2019-01-16" class="form-control">
     	</div>

     	</div>

     	<div class="form-group col-md-12">
     	<div class="col-md-1"><label>Tipo Benf:</label></div>
     	<div class="col-md-2">
     		<select name="cmbTipoBenf" id="cmbTipoBenf" class="form-control">
     			<option value="S">-- Seleccione --</option>
     			<option value="1"> Juridicos </option>
     			<option value="2"> Naturales </option>
     			<option value="3"> Interno </option>
     		</select>
     	</div>
     	<div class="col-md-1"><label>Código Beneficiario</label></div>
     		<div class="col-lg-2">
    			<div class="input-group">
      				<input type="text" class="form-control" id="id_benefidiario">
      				<span class="input-group-btn">
        				<button class="btn btn-success" type="button"   onclick="ver_modal2()">**</button>
      				</span>
    			</div>
  			</div>
  			<div class="col-lg-6">
  				<input type="text" name="beneficiario" id="beneficiario" class="form-control" placeholder="Nombre / Razon Social">
  			</div>
       </div>

       <div class="form-group col-md-12">
       	<div class="col-md-1"><label>Descripción:</label></div>
       	<div class="col-md-10">
       		<textarea rows="2" cols="40" class="form-control"></textarea>
       	</div>
       </div>

       <div class="form-group col-md-12">
       <button type="button" class="btn btn-primary">Agregar</button>
       	<div id="div_articulos" style="width: 100%; height: 300px; overflow: scroll;">
       		<table id="tblArticulos" class="table table-striped table-hover table-responsive table-bordered">
       			<thead style="background-color: #b32a0d; color: white;">
       				<tr>
    						<td colspan="6" align="center"><strong>ARTICULOS</strong></td>
    					</tr>
    					<tr>
    						<th align='center' width="5%"><strong>Cant</strong></th>
    						<th align='center'><strong>Articulo</strong></th>
    						<th align='center' width="17%"><strong>Precio U</strong></th>
    						<th align='center' width="17%"><strong>Stotal</strong></th>
    						<th align='center' width="7%">Eliminar</th>
    						<th align='center' width="5%"><strong>Exento</strong></th>
    					</tr>
       			</thead>
       			<tbody>
       				
       			</tbody>
       		</table>
       	</div>
       </div>

       <div class="form-group col-md-12">
       <button type="button" class="btn btn-primary">Agregar</button>
       	<div id="div_imputaciones" style="width: 100%; height: 300px; overflow: scroll;">
       		<table id="tblDetalle" class="table table-striped table-hover table-responsive table-bordered">
       			<thead  style="background-color: #b32a0d; color: white;">
       				<tr>
    						<th colspan="4" align="center"><strong><center>IMPUTACIÓN PRESUPUESTARIA</center></strong></th>
    					</tr>
    					<tr>
    						<th align='center'><strong>Código</strong></th>
    						<th align='center'><strong>Dominación</strong></th>
    						<th align='center'><strong>Monto</strong></th>
    						<th align='center' width="7%">Eliminar</th>
    					</tr>
       			</thead>
       			<tbody>
       				
       			</tbody>
       		</table>
       	</div>
       </div>

       </div> <!-- end panel body -->
   
      </form>

     </div>
    </div>
   </div>
 </div>
</div>
</div>

<div class="modal"
     id="modal_beneficiarios"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Benficiarios</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                  <input class="form-control" type="text" id="cadena" name="cadena" maxlength="60" placeholder="Cadena de Caracteres para Busqueda">
                  <button type="button" class="btn btn-primary" onclick="filtroEspecifica2()">Buscar</button>
               </div>
               <div id="area_resultados" class="form-group" style="height: 400px; overflow-y: scroll;">
               	
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
	
	function ver_modal2(){

		if($("#cmbTipoBenf").val().trim()!="S"){
			$("#modal_beneficiarios").modal("show");	
		}else{
			alert("Seleccione antes el Tipo de Beneficiario para ejecutar esta consulta");
		}
        
     }

</script>