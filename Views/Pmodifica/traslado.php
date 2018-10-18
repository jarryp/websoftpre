<?php session_start(); ?>
<style type="text/css">
 .barra-l{	
	height: 140px;
	width: 90%;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
	padding-left: 5px;
}

.centrado_vertical{
	text-align: center;
	line-height: 110px;
}

.text-total{
	background-color: yellow;
	text-align: right;
	font-size: 1.5em;
	font-weight: bold;
}

</style>

<div id="page-wrapper">
 <div id="page-inner">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-primary">
     <div class="panel-heading">
     	Usuario: <?php echo $_SESSION['n_usuario']; ?> | 
    	Traslados de Partidas
     </div>
     <div class="panel-body">
     	<form name="formTraslado" id="formTraslado">
     		<div class="form-group row">
     			<div class="col-md-4">
     				<label><strong>Traslados Registrados</strong></label>
     			</div>
     			<div class="col-md-8">
     			<select id="cmbIdModificacion" class="form-control" onchange="consultaLista()">
    				<option value="S">-- Seleccione --</option>
    			</select>
    			</div>
     		</div>
     		<div class="form-group row">
     			<div class="col-md-4">
     				<label>Código de la Cuenta</label>
     			</div>
     			<div class="col-md-4">
     				<input type="text" name="cod_especifica" id="cod_especifica" size="35" maxlength="35" class="form-control"  onblur="consulta()">
     				<input type="hidden" name="controlc" id="controlc">
     				<input type="hidden" name="controlr" id="controlr">
     			</div>
     			<div class="col-md-4">
     				<button type="button" class="btn btn-default"  onclick="busquedamodal()">Buscar</button>
     			</div>
     		</div>
     		<div class="form-group row">
     			<div class="col-md-4"><label>Denominación</label></div>
     			<div class="col-md-8"><input type="text" name="nombre" id="nombre" class="form-control"></div>
     		</div>
     		<div class="form-group row">
     			<div class="col-md-4"><label>Monto</label></div>
     			<div class="col-md-4"> <input type="text" name="monto" id="monto" class="form-control" placeholder="Monto Ejemplo: 1000.09"> </div>
     			<div class="col-md-4">
     				<label> <input type="radio" value="cedente" class="radio-inline" name="tipo_op" id="cedente" checked="checked"> Cedente</label>
     				<label> <input type="radio" value="receptora" class="radio-inline" name="tipo_op" id="receptora"> Receptora</label>
     				<button type="button" class="btn btn-success" style="float: right;" onclick="addrow()"> Agregar </button>
     			</div>
     		</div>
     	</form>
     </div> <!-- cuerpo del panel para formulario -->
    </div> <!-- fin de panel -->
   </div> <!-- fin div 12 columnas -->
  </div> <!-- fin de row -->

  <div class="row">
   <div class="col-md-12 col-sm-12">
    <div class="panel panel-default">
    	<div class="panel-heading">Tabla de Modificaciones Presupuestarias
    		
    	</div>
    	<div class="panel-body">
    	 <div role="tabpanel">
    		<ul class="nav nav-tabs" role="tablist" id="misTabs">
    		 	<li role="presentation" class="active"> 
    		 		<a href="#p_cedente" aria-controls="p_cedente" data-toggle="tab" role="tab">Cedentes</a>
    		 	</li>
    			<li role="presentation">
    				<a href="#p_receptora" aria-controls="p_receptora" data-toggle="tab" role="tab">Receptoras</a>
    			</li>
    		</ul>

    		<div class="tab-content">
    			<div role="tabpanel" class="tab-pane active" id="p_cedente">
    			 <div class="row">
    			 <div id="div_table_c" style="width: 100%; height: 450px; overflow: scroll;">
    			 <table id="tblDetalle1" class="table table-striped table-hover table-responsive table-bordered">
    				<thead>
    					<tr class="bg-warning">
    						<td colspan="4" align="center"><strong>CUENTAS PRESUPUESTARIAS CEDENTES</strong></td>
    					</tr>
    					<tr  class="bg-warning">
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
    			</div>
				<div role="tabpanel" class="tab-pane" id="p_receptora">
    			 <div class="row"> 
    			 <div id="div_table_r" style="width: 100%; height: 450px; overflow: scroll;">
    			 <table id="tblDetalle2" class="table table-striped table-hover table-responsive table-bordered">
    				<thead>
    					<tr class="bg-info">
    						<td colspan="4" align="center"><strong>CUENTAS PRESUPUESTARIAS RECEPTORAS</strong></td>
    					</tr>
    					<tr class="bg-info">
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
    			</div>

    		</div>

    	 </div>
    	 <!-- Configuración para la presentación de resultados en la parte final del formulario -->
    	 <div class="row">
    	 <div class="col-md-4 col-sm-4">

    	 </div>
    	 <div class="col-md-4 col-sm-4 centrado_vertical">
    	 	<button type="button" class="btn btn-primary" onclick="envia_traslado()">Guardar</button>
    	 </div>
    	 <div class="col-md-4 col-sm-4">
    	 <div style="float: right;">
    			Monto Cedentes:   <input type="text" name="totalc" id="totalc" maxlength="25" class="form-control text-total">
    			Monto Receptoras: <input type="text" name="totalr" id="totalr" maxlength="25" class="form-control text-total">
    	 </div>
    	 </div>
    	 </div>
    	 <!-- FIN Configuración para la presentación de resultados en la parte final del formulario -->
     </div>
    </div>	
   </div>
  </div>
 
 </div>
</div>


<div class="modal"
     id="ventana"
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
                <h4 class="modal-title" id="myModalLabel">Buscar Cuenta Presupuestaria</h4>
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


	function formatoTabla(xnombre_tabla){
	 	$("#"+xnombre_tabla).DataTable({
	 				"autowidth":"false",
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
                        "columnDefs":[
                        	{"width":"35", "targets":0},
                        	{"width":"200","targets":1},
                        	{"width":"50", "targets":2},
                        	{"width":"10", "targets":3}
                        ],
                        "fixedColumns":"true" 
                    }
                });
	 }

	$(document).ready(function(){
		
		$("#totalc").val(0);
		$("#totalr").val(0);
		var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
		document.getElementById("controlc").value=1;
		document.getElementById("controlr").value=1;
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Soportel/cargar_traslados",
	 		data:{id_periodo:xid_periodo},
	 		success:function(response){
	 			$("#cmbIdModificacion").html(response);
	 		}
	 	});

		$(".radio-inline").click(function(){
			var xobjeto = this.id;
			if(xobjeto.trim()=="cedente"){
				$('#misTabs a[href="#p_cedente"]').tab("show");
			}
			if(xobjeto.trim()=="receptora"){
				$('#misTabs a[href="#p_receptora"]').tab("show");
			}

		});

		$("#tblDetalle1").on("click", ".del", function(){
 		 var xresultado  = parseFloat(document.getElementById("totalc").value);
 		 document.getElementById("totalc").value = xresultado - parseFloat($(this).parents("tr").find("td").eq(2).html() ) ;
		 $(this).parents("tr").remove();
		});

		$("#tblDetalle2").on("click", ".del", function(){
 		 var xresultado  = parseFloat(document.getElementById("totalr").value);
 		 document.getElementById("totalr").value = xresultado - parseFloat($(this).parents("tr").find("td").eq(2).html() ) ;
		 $(this).parents("tr").remove();
		});

		formatoTabla("tblDetalle1");
		formatoTabla("tblDetalle2");

	});

	
	function consulta(){
	 	var xcod_spartida = document.getElementById("cod_especifica").value.trim();
	 	var xid_periodo   = "<?php echo $_SESSION['id_periodo']?>";
	 	if(xcod_spartida!=""){
	 		$.ajax({
	 			type:"GET",
	 			url: "<?php echo URL;?>Especifica/consulta",
	 			data:{cod_especifica:xcod_spartida,id_periodo:xid_periodo},
	 			success:function(response){
	 				var xdato = response.split("#");
	 				if(xdato[0]=="A"){
	 					document.getElementById("nombre").value= xdato[3].trim();
	 				}
	 			}
	 		});
	 	}
	 }

	function busquedamodal(){
        $("#ventana").modal("show");
     }


	function filtroEspecifica2(){
	 	var xid_periodo   = "<?php echo $_SESSION['id_periodo']?>";
	 	var xcadena = document.getElementById("cadena").value.trim();
        if(xcadena!=""){
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Especifica/lfiltro",
	 		data:{id_periodo:xid_periodo,cod_especifica:xcadena},
	 		success:function(response){
	 			$("#area_resultados").html(response);
	 		}
	 	});
	 	}else{
	 		alert("Ingrese Código de la cuenta presupuestaria");
	 	}
	 	
	 }

	 function pasarcodigo(xcodigo){
	 	document.getElementById("cod_especifica").value = xcodigo.trim();
	 	document.getElementById("cod_especifica").focus();
	 	document.getElementById("monto").value="";
	 	$("#ventana").modal("hide");
	 	document.getElementById("monto").focus();
	 } 

	 function addrow(){
	 	if($('input[name=tipo_op]:checked','#formTraslado').val().trim()=="cedente"){
	 		var xcont = parseInt(document.getElementById("controlc").value);
	 		var xtablaDetalle="tblDetalle1";
	 		var xobjControl ="controlc";
	 		var xobjTotal = "totalc";
	 	}
	 	if($('input[name=tipo_op]:checked','#formTraslado').val().trim()=="receptora"){
	 		var xcont = parseInt(document.getElementById("controlr").value);
	 		var xtablaDetalle="tblDetalle2";
	 		var xobjControl ="controlr";
	 		var xobjTotal = "totalr";
	 	}
	 	xcont = xcont + 1;
	 	var xcol1 = "col1_"+xcont.toString().trim();
	 	var xcol2 = "col2_"+xcont.toString().trim();
	 	var xcol3 = "col3_"+xcont.toString().trim();
	 	var xencontrado = 0;
	 	var xresultado  = 0;
	 	var xcont_cc = 0; // control de ciclo
	 	$("#"+xtablaDetalle+" tr").each(function(){
	 		if(xcont_cc>1){
	 			xcod_tabla =$(this).find("td").eq(0).html();
	 			if( xcod_tabla.trim() == document.getElementById("cod_especifica").value.trim() ){
	 				xencontrado=1;
	 			}
	 			//calculo de resultado
	 			xresultado+=parseFloat($(this).find("td").eq(2).html());
	 		}
	 		xcont_cc++;
	 	});
	 	if(xencontrado==0){
	 		$('#'+xtablaDetalle+' > tbody:first').append("<tr><td id='"+xcol1+"'>"+document.getElementById("cod_especifica").value+"</td><td id='"+xcol2+"'>"+document.getElementById("nombre").value+"</td><td id='"+xcol3+"' align='right'>"+document.getElementById("monto").value+"</td><td align='center'> <button type='button' class='del'>Eliminar</button> </td></tr>");

	 	 document.getElementById(xobjTotal).value = xresultado+parseFloat(document.getElementById("monto").value);
	 	 document.getElementById(xobjControl).value=xcont.toString().trim();
	 	}else{
	 		alert("Cuenta Presupuestaria ya ha sido seleccionada con aterioridad");
	 	}
	 }


	 function envia_traslado(){
	 	var xid_modificacion = $("#cmbIdModificacion").val();
	 	var xtotalc          = parseFloat($("#totalc").val());
	 	var xtotalr          = parseFloat($("#totalr").val());
	 	if(xid_modificacion=="S" || xtotalc<=0 || xtotalr<=0){
	 		alert("Campos requeridos Vacios");
	 	}else{
	 		if(xtotalc==xtotalr){
	 			//codigo para agregar
	 			var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
	 			var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
	 			var xcont_cc = 0;
	 			var xcont_cr = 0;
	 			var xcont_add_c = 0;
	 			var xcont_add_r = 0;
	 			$.ajax({
	 				type:"GET",
	 				url: "<?php echo URL;?>Pmodifica/limpiaMod",
	 				data:{id_soportel:xid_modificacion},
	 				success:function(response){
						var xlimpia = response;
					} 
				});

				$("#tblDetalle1 tr").each(function(){
					xcont_cc++;
				 if(xcont_cc>2){
					var xid_respuesta   = "";
	 				var xmonto          = $(this).find("td").eq(2).html();
	 				var xcod_especifica = $(this).find("td").eq(0).html();
	 				$.ajax({
	 						type:"GET",
	 						url:"<?php echo URL;?>Especifica/obtenerId",
	 						data:{cod_especifica:xcod_especifica.trim(),
	 							  id_periodo:xid_periodo},
	 						success:function(response){
	 							xid_respuesta = response.trim();
	 							$.ajax({
	 								type:"POST",
	 								url:"<?php echo URL;?>Pmodifica/add",
	 								data:{idusuario:xid_usuario,
	 									  id_periodo:xid_periodo,
	 									  id_especifica:xid_respuesta,
	 									  monto:xmonto,
	 									  id_soportel:document.getElementById("cmbIdModificacion").value,
	 									  id_tipo_modif:"2"},
	 								success:function(response){
	 									if(response.trim()=="1"){
	 										xcont_add_c++;
	 									}
	 									
	 								}
	 							});
	 						}
	 				}); 	
				 }
				});

				$("#tblDetalle2 tr").each(function(){
					xcont_cr++;
				  if(xcont_cr>2){
					var xid_respuesta   = "";
	 				var xmonto          = $(this).find("td").eq(2).html();
	 				var xcod_especifica = $(this).find("td").eq(0).html();
	 				$.ajax({
	 						type:"GET",
	 						url:"<?php echo URL;?>Especifica/obtenerId",
	 						data:{cod_especifica:xcod_especifica.trim(),
	 							  id_periodo:xid_periodo},
	 						success:function(response){
	 							xid_respuesta = response.trim();
	 							$.ajax({
	 								type:"POST",
	 								url:"<?php echo URL;?>Pmodifica/add",
	 								data:{idusuario:xid_usuario,
	 									  id_periodo:xid_periodo,
	 									  id_especifica:xid_respuesta,
	 									  monto:xmonto,
	 									  id_soportel:document.getElementById("cmbIdModificacion").value,
	 									  id_tipo_modif:"1"},
	 								success:function(response){
	 									if(response.trim()=="1"){
	 										xcont_add_r++;
	 									}
	 									
	 								}
	 							});
	 						}
	 				}); 
	 			  }	
				});

				alert("Procesando");

				if( ((xcont_cc-2) == xcont_add_c) && ( (xcont_cr-2) == xcont_add_r ) ){
					alert("Traslado entre cuentas Presupuestarias Procesado Satisfactoriamente");
				}else{
				 if(((xcont_cc-2)>xcont_add_c && xcont_add_c>0) && ((xcont_cr-2)>xcont_add_r && xcont_add_r>0)){
				 	alert("Registro Parcialmente Agregado");
				 }else{
				 	alert("Error de Registro de Traslado");
				 }
				}

	 		}else{
	 			alert("Atención: El total de modificaciones Cedentes debe ser igual a las Receptoras");
	 		}
	 	}

	 	
	 }

	 function consultaLista(){
	 	var xid_modificacion = $("#cmbIdModificacion").val();
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Pmodifica/listaCedentes",
	 		data:{id_soportel:xid_modificacion,
	 			  id_tipo_modif:"2"},
	 		success:function(response){
	 			$("#div_table_c").html(response);
	 		}
	 	});

	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Pmodifica/listaReceptoras",
	 		data:{id_soportel:xid_modificacion,
	 			  id_tipo_modif:"1"},
	 		success:function(response){
	 			$("#div_table_r").html(response);
	 		}
	 	});

	 }



	


</script>