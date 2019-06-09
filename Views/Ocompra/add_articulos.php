<div class="modal"
     id="modal_articulos"
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
                <h4 class="modal-title" id="myModalLabel">Procesar Articulos</h4>
            </div>
        <div class="modal-body">
            <form role="form" id="formArtitulo" name="formArtitulo">
                <div class="form-group">
                	<div class="col-md-1">
                		<label>Cantidad:</label>
                	</div>
                	<div class="col-md-11">
                		<input type="text" name="cantidad" id="cantidad" placeholder="0.00">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-1">
                		<label>Articulo:</label>
                	</div>
                	<div class="col-md-11">
                		<input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre del articulo" maxlength="80">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-1">
                		<label>Impuesto:</label>
                	</div>
                	<div class="col-md-11">
                		<input type="radio" name="excento" value="Aplica">Aplica IVA
                		<input type="radio" name="excento" value="Excento"> Excento
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-1">
                		<label>Precio Unitario:</label>
                	</div>
                	<div class="col-md-11">
                		<input type="text" name="preciou" id="preciou" placeholder="1000.00">
                	</div>
                </div>

                	<div class="col-md-12">
                		<label>Partida:</label>
                		<select id="cmbPartida" name="cmbPartida" class="form-control" onchange ="cargarCuentaPorPartida()">
                		<option value="S">-- Seleccione --</option>
                		<?php 
                			$json = file_get_contents(URL."Partida/listado2?id_periodo=".$_SESSION['id_periodo']);
                			if($json!=NULL){
                      			$datos = json_decode($json);
                      			foreach($datos as $partida){
                      				echo "<option value='$partida->cod_partida'>$partida->descripcion</option>";
                      			}
                      		}
                		?>
                		</select>
                		<br>
                		<div class="form-group col-md-12">
       						<div class="col-md-3"><label>Framento de Código:</label></div>
     						<div class="col-md-4">
     							<div class="input-group">
      								<input type="text" class="form-control" id="cadena3" name="cadena3">
      								<span class="input-group-btn">
        							<button class="btn btn-success" type="button" onclick="filtrarEspecifica3()">**</button>
      								</span>
    							</div>
     						</div>
     					</div>
                		<br>
                		<select id="cmbCuenta" name="cmbCuenta" class="form-control">
                			<option value="S"> -- Seleccione -- </option>
                		</select>
                		<br>

                	</div>
                	<div class="col-md-12">
                		<button style="float: left;" 
                		        class="btn btn-primary" 
                		        onclick="addRowArticulo()">Agregar</button>
                	</div>

             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>