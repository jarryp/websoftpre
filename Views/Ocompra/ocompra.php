

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
		 <input type="hidden" class="form-control" id="id" name="id">
     		<div class="input-group">
      				<input type="text" class="form-control" id="cod_ocompra" name="cod_ocompra">
      				<span class="input-group-btn">
        				<button class="btn btn-default" type="button" >**</button>
      				</span>
    		</div>
     	</div>
     	<div class="col-md-1"><label>Fecha</label></div>
     	<div class="col-md-3">
			 <input type="date" name="fecha" id="fecha" 
					maxlength="10" placeholder="2019-01-16" class="form-control"
					value="<?php echo date('Y-m-d');?>">
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
      				<input type="text" class="form-control" id="id_beneficiario" onblur="busca_benf()">
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
       <button type="button" class="btn btn-primary" onclick="ver_modal3()">Agregar</button>
       	<div id="div_articulos" style="width: 100%; height: 300px; overflow: scroll;">
       		<table id="tblArticulos" class="table table-striped table-hover table-responsive table-bordered">
       			<thead style="background-color: #b32a0d; color: white;">
       				<tr>
    						<td colspan="7" align="center"><strong>ARTICULOS</strong></td>
    					</tr>
    					<tr>
    						<th align='center' width="5%"><strong>Cant</strong></th>
    						<th align='center'><strong>Articulo</strong></th>
    						<th align='center' width="17%"><strong>Precio U</strong></th>
    						<th align='center' width="17%"><strong>Stotal</strong></th>
    						<th align='center' width="7%">Eliminar</th>
    						<th align='center' width="5%"><strong>Exento</strong></th>
    						<th align='center'><strong>Imputa</strong></th>
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




<?php 
/*  AGREGANDO VENTANAS MODALES PARA PROCESAMIENTO Y 
    CONSULTA DE DATOS SOBRE ARCHIVOS MAESTROS  */
	require_once("consultaBeneficiario.php"); 
	require_once("add_articulos.php"); 
	require_once("add_natural.php"); 
	require_once("add_juridico.php"); 
	require_once("add_interno.php"); 
?>



<script type="text/javascript">


	
	
	function ver_modal2(){
		$("#modal_beneficiarios").modal("show");	
     }


     function ver_modal3(){
		$("#modal_articulos").modal("show");	
     }

     function cargarCuentaPorPartida(){
     	var xcod_partida = document.getElementById("cmbPartida").value.trim();
     	var xid_periodo  = "<?php echo $_SESSION['id_periodo']?>";
     	$.ajax({
     		type:"GET",
     		url:"<?php echo URL;?>Especifica/cargarComboPorPartida",
     		data:{cod_partida:xcod_partida,id_periodo:xid_periodo},
     		success:function(response){
     			$("#cmbCuenta").html(response);
     		}

     	});
     }

     function filtrarEspecifica3(){
     	var xcadena     = document.getElementById("cadena3").value.trim();
     	var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
     	$.ajax({
     		type:"GET",
     		url:"<?php echo URL;?>Especifica/cargarComboPorCadena",
     		data:{cadena:xcadena,id_periodo:xid_periodo},
     		success:function(response){
     			$("#cmbCuenta").html(response);
     		}

     	});
     }

	 function busca_benf(){
		var xid_entidad      = "<?php echo $_SESSION['id_entidad']?>";
		var xid_tipo_benf    = $("#cmbTipoBenf").val();
		var xid_beneficiario = $("#id_beneficiario").val();

		if(xid_tipo_benf!="S"){
		$.ajax({
     		type:"GET",
     		url:"<?php echo URL;?>Funciones/getNombreBeneficiario",
     		data:{id_entidad:xid_entidad,id_tipo_benf:xid_tipo_benf,
			      id_beneficiario:xid_beneficiario},
     		success:function(response){
				 xdata = response.trim().split("#");
				if(xdata[0]=="A"){
					$("#beneficiario").val(xdata[1]);
				}else{
					if(xid_tipo_benf == "1"){
				    	formJuridico();
					}
					if(xid_tipo_benf == "2"){
				    	formNatural();
					}
					if(xid_tipo_benf == "3"){
				    	formInterno();
					}
				}
     		}

     	});
		}else{
			alert("Seleccione tipo de Beneficiario");
		}

	 }
	 
	 function setNumOcompra(){
		var xid_periodo =  "<?php echo $_SESSION['id_periodo']?>";
		$.ajax({
			type:"GET",
			url: "<?php echo URL;?>Periodop/getNumOcompra",
			data:{id_periodo:xid_periodo},
			success:function(response){
				xdata = response.trim().split("#");
				if(xdata[0]=="A"){
					xcodigo = parseInt(xdata[1])+1;
					if(xcodigo.length>1){
						$("#cod_ocompra").val(xcodigo);
					}else{
						$("#cod_ocompra").val("0"+xcodigo);
					}
				}else{
					$("#cod_ocompra").val("");
				}
			}
		});
	 }



	 function formJuridico(){
                 $("#id_bjuridico").val("");
                 $("#rif").val("");
                 document.getElementById("nombre").value    = "";
                 document.getElementById("telefono").value  = "";
                 document.getElementById("email").value     = "";
                 document.getElementById("direccion").value = "";
                 $("#rif").focus();
                 $("#addJuridico").modal("show");
    }

	
	function formNatural(){
        $("#id_bnatutal").val("");
        document.getElementById("cedula").value    = "";
        document.getElementById("nombres").value   = "";
        document.getElementById("apellidos").value = "";
        document.getElementById("telefono").value  = "";
        document.getElementById("email").value     = "";
        document.getElementById("direccion").value = "";
        document.getElementById("cedula").focus();
        $("#addNatural").modal("show");
    }

	
	function formInterno(){
        $("#descripcion").value = "";
        $("#addInterno").modal("show");
        $("#descripcion").focus();
    }
	
	function pasarBenf(xtipo,xcodigo){
		
		$("#cmbTipoBenf").val(xtipo);
		$("#id_beneficiario").val(xcodigo);
		$("#modal_beneficiarios").modal("hide");
		$("#id_beneficiario").focus();
		$("#beneficiario").focus();
		

	}

	 $(document).ready(function(){

		$("#tablaBeneficiarios").DataTable({
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

		setNumOcompra();
		$("#cod_ocompra").focus();
	 });
	 
</script>