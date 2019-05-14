<div class="container">
	<div class="card card card-container">
	<img src="<?php echo URL.VIEWS.DFT."img/logo_ps.jpg"; ?>" class="img" width="100%" height="60%">
		<h2 class="titleLogin">Inicia Sesi&oacute;n</h2>
		<form class="form-signin" id="sesion" name="sesion" method="POST">
			<label>Usuario</label>
			<input type="email" 
			       name="email" 
			       id="email" 
			       class="form-control"
			       placeholder="e-mail or user">
			<label>Contraseña</label>
			<input type="password" 
			       name="passwd" 
			       id="passwd" 
			       class="form-control"
			       placeholder="Contraseña">
			<label>Entidad</label>
			<select id="cmbEntidad" 
					name="cmbEntidad"
					class="form-control"
					placeholder="Entidad"
					onchange="javascript:cargarperiodos()">
				<?php
				$json= file_get_contents(URL."Entidad/Listado");
                    	$datos = json_decode($json);
                    	foreach($datos as $lentidad){
                    		echo "<option value='S'>Seleccione...</option>
                    		      <option value='$lentidad->id_entidad'>$lentidad->descripcion</option>";
                    	}
               ?>
			</select>
			<label>Periodo</label>
			<select id="cmbPeriodo" name="cmbPeriodo" class="form-control">
				<option value="S">Seleccione...</option>
			</select>
			<button type="button" 
			        class="btn btn-primary"
			        onclick="javascript:valida_acceso()" 
			        id="btnLogn">Iniciar Sesion</button>
		</form>
		<br>
		<br />
		<a href="Index/signIn">Registrarse</a>
	</div>
</div>

<script type="text/javascript">


	function valida_acceso(){
		var email   = document.getElementById("email").value.trim();
		var passwd  = document.getElementById("passwd").value.trim();
		var entidad = document.getElementById("cmbEntidad").value.trim();
		var periodo = document.getElementById("cmbPeriodo").value.trim();
		var Controller_Method ="User/userLogin";

		if(email=="" || passwd=="" || entidad=="S" || periodo=="S")
		{
			alert("Datos requeridos Vacios");
		}else{
		$.ajax({
			type:"POST",
			url:"<?php echo URL;?>User/usuarioLogin",
			data:{email:email, passwd:passwd,entidad:entidad,periodo:periodo},
			success:function(response){
				if(response==1){
					document.location ="<?php echo URL;?>Principal/principal";
				}else{
				    alert(response);
					alert("Email o Contraseña Incorrectos");
				}
			}
		});
		
		}
	
	}


	function cargarperiodos(){
		var xid_entidad = document.getElementById("cmbEntidad").value;
		$.ajax({
			type:"GET",
			url:"<?php echo URL;?>Periodop/cargarCombo",
			data:{id_entidad:xid_entidad},
			success:function(response){
				$("#cmbPeriodo").html(response);
			}
		});
	}


</script>