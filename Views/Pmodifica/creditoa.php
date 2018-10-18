
<style type="text/css">
 .barra-l{	
	height: 140px;
	width: 90%;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
	padding-left: 5px;
}

</style>
<div id="page-wrapper">
 <div class="row" style="padding-left: 24px; padding-bottom: 5px;" id="marco_listados">
   <div id="area_listado" class="barra-l">
   </div>
 </div>
    <div id="page-inner">
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">
    				Usuario: <?php echo $_SESSION['n_usuario']; ?> | 
    				Registro de Créditos Adicionales y Reducciones al Presupuesto
    			</div>
    			<div class="panel-body">
    				<form>
    				<table width="100%" class="table table-responsive">
    				<tbody>
    				<tr>
    				 <td width="20%" align="right">Créditos / Reducciones Registrados</td>
    				 <td>
    				 	<select id="cmbIdModificacion" class="form-control" onchange="consultaLista()">
    						<option value="S">-- Seleccione --</option>
    					</select>
    				 </td>
    				</tr>
    				<tr>
    					<td align="right">Código de la Cuenta</td>
    					<td>
    						<input type="text" name="cod_spartida" id="cod_spartida" placeholder="Código de Cuenta Presupuestaria" maxlength="35" size="40" onblur="consulta()">
    						<!--
    						<button type="button" class="btn btn-primary" onclick="filtroEspecifica()">Buscar</button>
    						<a href="<?php echo URL;?>Especifica/busqueda" rel="pop-up">Ver</a></p>
    						<input type="hidden" name="id_spartida" id="id_spartida"> -->
    						<button type="button" class="btn btn-success" onclick="busquedamodal()">Buscar</button>
    					</td>
    				</tr>
    				<tr>
    					<td align="right">Denominación</td>
    					<td>
    						<input type="text" name="nombre" id="nombre" placeholder="Denominación" class="form-control">
    					</td>
    				</tr>
    				<tr>
    					<td align="right">Monto</td>
    					<td>
    						<input type="text" name="monto" id="monto" placeholder="Monto Ejemplo: 1000.09" class="form-control">
    					</td>
    				</tr>
    				<tr>
    					<td colspan="2" align="center">
    						<strong>Total Procesado: </strong>
    						<input type="text" name="total" id="total" placeholder="Total">
    					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
    						<button type="button" class="btn btn-success" style="float: right;" onclick="addrow()"> Agregar </button>
    					</td>
    				</tr>
    				</tbody>
    				</table>	
    				<input type="hidden" name="control" id="control" value="0">
    				
    				<div class="row">
    				<div id="div_table" style="width: 100%; height: 450px; overflow: scroll;">
    				<table id="tblDetalle" class="table table-striped table-hover table-responsive table-bordered">
    				<thead>
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
    				<center> <button type="button" class="btn btn-primary" id="btnGuardar" onclick="recorre_impt()">Guardar</button> </center>

    				</form>
    				
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
                        	{"width":"35px","targets":0},
                        	{"width":"200px","targets":1},
                        	{"width":"50px","targets":2},
                        	{"width":"10px","targets":3}
                        ]
                    }
                });
	 }

	
	 $(document).ready(function(){

	 	$('#marco_listados').hide();
     
		var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Soportel/cargar_credreduc",
	 		data:{id_periodo:xid_periodo},
	 		success:function(response){
	 			$("#cmbIdModificacion").html(response);
	 		}
	 	});


	 	$("a[rel='pop-up']").click(function () {
      		var caracteristicas = "height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0";
      		nueva=window.open(this.href, 'Popup', caracteristicas);
      		return false;
 		});


 		$("#tblDetalle").on("click", ".del", function(){

 			var xresultado  = parseFloat(document.getElementById("total").value);
 			document.getElementById("total").value = xresultado - parseFloat($(this).parents("tr").find("td").eq(2).html() ) ;
			$(this).parents("tr").remove();
		});

		formatoTabla("tblDetalle");

	 });

	 function busquedamodal(){
        $("#ventana").modal("show");
     }

	 function addrow(){
	 	var xcont = parseInt(document.getElementById("control").value);
	 	xcont = xcont + 1;
	 	var xcol1 = "col1_"+xcont.toString().trim();
	 	var xcol2 = "col2_"+xcont.toString().trim();
	 	var xcol3 = "col3_"+xcont.toString().trim();
	 	var xencontrado = 0;
	 	var xresultado  = 0;
	 	var xcont=0;
	 	$("#tblDetalle tr").each(function(){
	 	if(xcont>0){
	 		xcod_tabla =$(this).find("td").eq(0).html();
	 	 if( xcod_tabla.trim() == document.getElementById("cod_spartida").value.trim() ){
	 			xencontrado=1;
	 	 }
		 xresultado+=parseFloat($(this).find("td").eq(2).html());
 		}
	 	xcont=xcont+1;
	 	});
	 	if(xencontrado==0){
	 	$('#tblDetalle > tbody:first').append("<tr><td id='"+xcol1+"'>"+document.getElementById("cod_spartida").value+"</td><td id='"+xcol2+"'>"+document.getElementById("nombre").value+"</td><td id='"+xcol3+"' align='right'>"+document.getElementById("monto").value+"</td><td align='center'> <button type='button' class='del'>Eliminar</button> </td></tr>");
	 	   document.getElementById("total").value = xresultado+parseFloat(document.getElementById("monto").value);
	 	   document.getElementById("control").value=xcont.toString().trim();
	    }else{
	 		alert("Cuenta Presupuestaria ya ha sido seleccionada con aterioridad");
	 	}
	    
	 }	 

	 function consulta(){
	 	var xcod_spartida = document.getElementById("cod_spartida").value.trim();
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

	 function filtroEspecifica(){
	 	var xid_periodo   = "<?php echo $_SESSION['id_periodo']?>";
	 	var xcod_spartida = document.getElementById("cod_spartida").value.trim();
        if(xcod_spartida!=""){
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Especifica/lfiltro",
	 		data:{id_periodo:xid_periodo,cod_especifica:xcod_spartida},
	 		success:function(response){
	 			$('#marco_listados').show();
	 			$("#area_listado").html(response);
	 		}
	 	});
	 	}else{
	 		alert("Ingrese Código de la cuenta presupuestaria");
	 	}
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

	 function limpiar_arealistado(){
	 	$("#area_listado").html("");
	 	$('#marco_listados').hide();
	 }

	 function pasarcodigo(xcodigo){
	 	document.getElementById("cod_spartida").value = xcodigo.trim();
	 	document.getElementById("cod_spartida").focus();
	 	document.getElementById("monto").value="";
	 	$("#ventana").modal("hide");
	 	document.getElementById("monto").focus();
	 } 

	 function recorre_impt(){
	 	var xn_impts = ($("#tblDetalle tr").length-1);
	 	var xid_modificacion = document.getElementById("cmbIdModificacion").value;

	 	if(xn_impts == 0 || xid_modificacion=="S"){
	 		alert("Campos Requeridos Vacios");
	 	}else{
	 		//alert("pasa a guardar");
	 		var xid_periodo = "<?php echo $_SESSION['id_periodo']?>";
	 		var xid_usuario = "<?php echo $_SESSION['idusuario']?>";
	 		var xcont = 0;
	 		var xcont_agrega = 0;
	 		$("#tblDetalle tr").each(function(){
	 			xcont++;
	 			if(xcont>1){

	 				if(xn_impts>0){
	 					$.ajax({
	 						type:"GET",
	 						url: "<?php echo URL;?>Pmodifica/limpiaMod",
	 						data:{id_soportel:xid_modificacion},
	 						success:function(response){

	 							var xlimpia = response;
	 						} 
	 					});
	 				}

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
	 										xcont_agrega++;
	 									}
	 									
	 								}
	 							});
	 						}
	 					}); 			
	 			}
	 		});
	 		alert("Procesando");
	 		if( (xcont-1) == xcont_agrega ){
	 			alert("Credito Adicional Procesado Satisfactoriamente");
	 		}else{
	 			if((xcont-1)>xcont_agrega && xcont_agrega>0 ){
	 				alert("Registro Parcialmente Agregado");
	 			}else{
	 				alert("Error de Registro de Credito Adicional");
	 			}
	 		}

	 	}

	 }


	 function consultaLista(){
	 	var xid_modificacion = document.getElementById("cmbIdModificacion").value;
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Pmodifica/lista",
	 		data:{id_soportel:xid_modificacion},
	 		success:function(response){
	 			$("#div_table").html(response);
	 		}
	 	});
	 }


</script>