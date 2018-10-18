<form action="#">
	<div class="form-group">
		<input type="text" name="cadena" id="cadena" maxlength="50">
		<button type="button" class="btn btn-default" onclick="filtroEspecifica()">Buscar</button>
	</div>
	<div id="area_resultados">
		
	</div>
</form>


<script type="text/javascript">


	function pasarcodigo(xcodigo){
	 	window.opener.document.getElementById("cod_spartida").value = xcodigo.trim();
	 	window.opener.document.getElementById("cod_spartida").onblur();
	 	window.opener.document.getElementById("monto").focus();
	 	window.close();
	 } 
	
	function filtroEspecifica(){
	 	var xid_periodo   = "<?php echo $_SESSION['id_periodo']?>";
	 	var xcod_spartida = document.getElementById("cadena").value.trim();
        if(xcod_spartida!=""){
	 	$.ajax({
	 		type:"POST",
	 		url: "<?php echo URL;?>Especifica/lfiltro",
	 		data:{id_periodo:xid_periodo,cod_especifica:xcod_spartida},
	 		success:function(response){
	 			$("#area_resultados").html(response);
	 		}
	 	});
	 	}else{
	 		alert("Ingrese Código de la cuenta presupuestaria");
	 	}
	 }

</script>