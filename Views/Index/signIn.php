<div class="container">
	<div class="card card-container">
	<h2 class="titleLogin">Registrarse</h2>
		<form class="form-signin" method="POST" id="Registrar" name="Registrar">
		<input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
		<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Apellido">
		<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
		<input type="email" name="email" id="email" class="form-control" placeholder="Correo electronico">
		<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Contraseña">
		<button class="btn btn-signin" type="submit" id="signin">Registrar</button>
			
		</form><br>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$("#signin").click(function(){
			var name     = document.getElementById("name").value.trim();
			var lastname = document.getElementById("lastname").value.trim();
			var usuario  = document.getElementById("usuario").value.trim();
			var email    = document.getElementById("email").value.trim();
			var passwd   = document.getElementById("pwd").value.trim();
			var Controller_Method ="User/signIn";

			if( name=="" || lastname=="" || usuario=="" || email=="" || passwd==""){
				//validacion campos vacios
				//alert("Campos Requeridos vacios");
			}else{
				//de lo contrario de evaluacion de llenado de objetos (todos llenos)
				$.ajax({
					type:"POST",
					url:"<?php echo URL;?>"+Controller_Method,
					data:{name:name,lastname:lastname,usuario:usuario,email:email,passwd:passwd},
					success:function(response){
						if(response==1){
							alert("Usuario Registrado Satisfactoriamente");
							document.location = "<?php echo URL; ?>";
						}else{

							if(response==2){
								alert("Email ya registrado en la base de datos");
							}else{
								alert("Usuario No Registrado....");
							}
							
						}
					}
				});
			}
			return false;
		});
	});
</script>