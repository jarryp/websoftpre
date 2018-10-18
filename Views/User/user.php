<?php
	$UserName = Session::getSession("usuario");
?>



<div id="page-wrapper">
    <div id="page-inner">

    	<!-- ROW  -->
    	<div class="row">
            <div class="col-md-12">
            <h1 class="page-header">
                Usuarios <small>Niveles de Acceso</small>
            </h1>
            </div>
        </div>
        <!-- /. ROW  -->
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
            		<table class="display" id="tablaUsuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Edita</th>
                            <th>Acceso</th>
                            <th>Elimina</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    	$json= file_get_contents(URL."User/Listado");
                    	$datos = json_decode($json);
                    	foreach($datos as $lusuario){
                            if($lusuario->estado=="t"){
                                $estado="Activo";
                            }else{
                                $estado="Bloqueado";
                            }
                    		echo "<tr>
                    				<td> ". $lusuario->name."</td>
                    				<td> ". $lusuario->lastname ."</td>
                    				<td> ". $lusuario->usuario ."</td>
                    				<td> ". $lusuario->email ."</td>
                                    <td> ".$estado."</td>
                    				<td> <button class='btn btn-success' onclick='javascript:verventanamodalEditar($lusuario->iduser)'>Editar</button> </td>
                    				<td> <button class='btn btn-warning' onclick='javascript:verventanamodalRoles()'>Asignar</button> </td>
                    				<td> <button class='btn btn-danger' onclick='javascript:elimina_usuario($lusuario->iduser)'>Elimiar</button></td>
                    		      </tr>";
                    	}
                     ?>
                    </tbody>
                    </table>
            	</div>
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

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Añadir Usuario</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input class="form-control" type="text" id="Name" name="Name" maxlength="30">
                    <label>Apellido:</label>
                    <input class="form-control" type="text" id="LastName" name="LastName" maxlength="30">
                </div>
                <div class="form-group">
                    <label>Usuario:</label>
                    <input class="form-control" type="text" id="usuario" name="usuario" maxlength="30">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="email" id="email" name="email" maxlength="100" placeholder="usuario@dominio.com">
                </div>
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input class="form-control" type="password" id="password" name="password" maxlength="30">
                </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javaescript:envia_usuario()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>

<div class="modal"
     id="form_editar"
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
                <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
            </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="hidden" id="Edt_iduser" name="Edt_iduser">
                    <input class="form-control" type="text" id="Edt_Name" name="Edt_Name" maxlength="30">
                    <label>Apellido:</label>
                    <input class="form-control" type="text" id="Edt_LastName" name="Edt_LastName" maxlength="30">
                </div>
                <div class="form-group">
                    <label>Usuario:</label>
                    <input class="form-control" type="text" id="Edt_usuario" name="Edt_usuario" maxlength="30">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="email" id="Edt_email" name="Edt_email" maxlength="100" placeholder="usuario@dominio.com">
                </div>
                <div class="form-group">
                    <label>Reiniciar Contraseña:</label>
                    <select id="cambiaPwd">
                        <option value="1">NO</option>
                        <option value="2">SI</option>
                    </select>
                    <label>Estado</label>
                    <select id="combEstado">
                        <option value="1">Activo</option>
                        <option value="2">Bloqueado</option>
                    </select>
                </div>
                  <button type="button"
                          class="btn btn-primary"
                          onclick="javaescript:edita_usuario()">Guardar</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>

<div class="modal"
     id="form_asignarol"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel">

<style>
ul{
    list-style-type: none;
    margin: 3px;
}
ul.checktree li:before{
    height: 1em;
    width: 12px;
    border-bottom: 1px dashed;
    content: "";
    display: inline-block;
    top: -0.3em;
}
ul.checktree li{
    border-left: 1px dashed;
}
ul.checktree li:last-child:before {
    border-left: 1px dashed;
}
ul.checktree li:last-child{
    border-left: none;
}

.div_scroll{
    background:#ddddbb;
    height: 440px;
    overflow-y: scroll;
    overflow-x: scroll;
    width: 100%; 
}
</style>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Configuración de Perfil de Acceso</h4>
            </div>
        <div class="modal-body">
            <div class="div_scroll">
			<ul class="checktree">
				<li>
					<input id="mp_presupuesto" type="checkbox" /><label for="mp_presupuesto">Presupuesto</label>
						<ul>
							<li>
							<input id="mp1_beneficiarios" type="checkbox" /><label for="mp1_beneficiarios">Beneficiarios</label>
                              <ul>
                                  <li><input id="mp12_juridicos" type="checkbox" /><label for="mp12_juridico">Juridicos</label></li>
                                  <li><input id="mp12_naturales" type="checkbox" /><label for="mp12_naturales">Naturales</label></li>
                                  <li><input id="mp12_interno" type="checkbox" /><label for="mp12_interno">Interno</label></li>
                              </ul>
							</li>
							<li>
							<input id="mp1_maestros" type="checkbox" /><label for="mp1_maestros">Maestros</label>
                              <ul>
                                <li><input id="mp13_periodos" type="checkbox"/><label for="mp13_periodos">Periodos</label></li>
                                <li><input id="mp13_sector" type="checkbox"/><label for="mp13_sector">Sector</label></li>
                                <li><input id="mp13_programa" type="checkbox"/><label for="mp13_programa">Programa</label></li>
                                <li><input id="mp13_obra" type="checkbox"/><label for="mp13_obra">Obras</label></li>
                                <li><input id="mp13_actividad" type="checkbox"/><label for="mp13_actividad">Actividad</label></li>
                                <li><input id="mp13_partida" type="checkbox"/><label for="mp13_partida">Partida</label></li>
                                <li><input id="mp13_generica" type="checkbox"/><label for="mp13_generica">Generica</label></li>
                                <li><input id="mp13_subpartica" type="checkbox"/><label for="mp13_subpartica">Sub-Partida</label></li>
                              </ul>
							</li>
							<li>
						  	<input id="mp1_ejecucion" type="checkbox" /><label for="mp1_ejecucion">Ejecución</label>
                             <ul>
                                 <li><input id="mp14_oc" type="checkbox"/><label for="mp14_oc">Orden de Compra</label></li>
                                 <li><input id="mp14_os" type="checkbox"/><label for="mp14_os">Orden de Servicio</label></li>
                                 <li><input id="mp14_op1" type="checkbox"/><label for="mp14_op1">Orden de Pago con Afectación Presupuestaria</label></li>
                                 <li><input id="mp14_op2" type="checkbox"/><label for="mp14_op2">Orden de Pago Fiscal</label></li>
                             </ul>
							</li>
							<li>
							<input id="mp1_modificaciones" type="checkbox" /><label for="mp1_modificaciones">Modificaciones</label>
                            <ul>
                                 <li><input id="mp15_spl" type="checkbox"/><label for="mp15_spl">Soporte Legal</label></li>
                                 <li><input id="mp15_cda" type="checkbox"/><label for="mp15_cda">Creditos Adicionales / Reducciones</label></li>
                                 <li><input id="mp15_tlp" type="checkbox"/><label for="mp15_tlp">Traslados</label></li>
                             </ul>
						    </li>
					    </ul>
				</li>
			<li>
              <input id="mp2_rrhh" type="checkbox" /><label for="mp_rrhh">Recursos Humanos</label>
              <ul>
              <li>
                  <input id="mp21_rrhh" type="checkbox" /><label for="mp21_rrhh">Maestros</label>
                  <ul>
                      <li><input id="mp211_rrhh" type="checkbox" /><label for="mp211_rrhh">Departamentos</label></li>
                      <li><input id="mp212_rrhh" type="checkbox" /><label for="mp212_rrhh">Tipo de Personal</label></li>
                      <li><input id="mp213_rrhh" type="checkbox" /><label for="mp213_rrhh">Periodos de Pago</label></li>
                      <li><input id="mp214_rrhh" type="checkbox" /><label for="mp214_rrhh">Nivel Academico</label></li>
                      <li><input id="mp215_rrhh" type="checkbox" /><label for="mp215_rrhh">Cargos</label></li>
                      <li><input id="mp216_rrhh" type="checkbox" /><label for="mp216_rrhh">Asignaciones</label></li>
                      <li><input id="mp217_rrhh" type="checkbox" /><label for="mp217_rrhh">Deducciones</label></li>
                  </ul>
              </li>
              <li><input id="mp22_rrhh" type="checkbox" /><label for="mp22_rrhh">Personal</label></li>
              <li><input id="mp23_rrhh" type="checkbox" /><label for="mp23_rrhh">Nominas</label></li>
              <li><input id="mp24_rrhh" type="checkbox" /><label for="mp24_rrhh">Bono Alimentación</label></li>
              <li><input id="mp25_rrhh" type="checkbox" /><label for="mp25_rrhh">Vacaciones</label></li>
              <li><input id="mp26_rrhh" type="checkbox" /><label for="mp26_rrhh">Aguinaldos</label></li>
              <li><input id="mp27_rrhh" type="checkbox" /><label for="mp27_rrhh">Calculo de Retroactivos</label></li>
              <li><input id="mp28_rrhh" type="checkbox" /><label for="mp28_rrhh">Curriculums</label></li>
              </ul>
            </li>
            <li>
                <input id="mp3_tm" type="checkbox" /><label for="mp3_tm">Tesorería Municipal</label>
                <ul>
                    <li><input id="mp31_tm" type="checkbox" /><label for="mp31_tm">Beneficiarios EP</label></li>
                    <li><input id="mp32_tm" type="checkbox" /><label for="mp32_tm">Bancos</label></li>
                    <li><input id="mp33_tm" type="checkbox" /><label for="mp33_tm">Cuentas Bancarias</label></li>
                    <li><input id="mp34_tm" type="checkbox" /><label for="mp34_tm">Movimientos Bancarios</label></li>
                    <li><input id="mp35_tm" type="checkbox" /><label for="mp35_tm">Conciliaciones Bancarias</label>
                        <ul>
                            <li><input id="mp351_tm" type="checkbox" /><label for="mp351_tm">Saldos Bancarios Mensuales (Estados de Cuentas)</label></li>
                            <li><input id="mp351_tm" type="checkbox" /><label for="mp351_tm">Registro de Cobro de EP</label></li>
                            <li><input id="mp351_tm" type="checkbox" /><label for="mp351_tm">Conciliación Bancaria</label></li>
                        </ul>
                    </li>
                    <li><input id="mp36_tm" type="checkbox" /><label for="mp36_tm">Emitir Pagos</label></li>
                    <li><input id="mp37_tm" type="checkbox" /><label for="mp37_tm">Libro Auxiliar de Bancos</label></li>
                    <li><input id="mp38_tm" type="checkbox" /><label for="mp38_tm">Libro Auiliar de Tesoreria</label></li>
                </ul>
            </li>
            <li><input id="mp4_rm" type="checkbox" /><label for="mp4_rm">Rentas Municipales</label>
                 <ul>
                    <li><input id="" type="checkbox" /><label for="">Vehículos</label></li>
                    <li><input id="" type="checkbox" /><label for="">Maestros</label></li>
                    <li><input id="" type="checkbox" /><label for="">Presupuesto</label></li>
                    <li><input id="" type="checkbox" /><label for="">Contribuyentes</label></li>
                    <li><input id="" type="checkbox" /><label for="">Pre-Facturación</label></li>
                    <li><input id="" type="checkbox" /><label for="">Facturación</label></li>
                 </ul>
            </li>
            <li><input id="mp5_cnf" type="checkbox" /><label for="mp5_cnf">Configuración</label>
                 <ul>
                    <li><input id="" type="checkbox" /><label for="">Control de Códigos Automaticos</label></li>
                    <li><input id="" type="checkbox" /><label for="">Usuarios</label></li>
                 </ul>
            </li>

            </ul>

            
                


			</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>

</div>



        <script>
            $(document).ready(function(){
                $("#tablaUsuarios").DataTable({
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
                 $("#ventana").modal("show");
            }

            function verventanamodalRoles(){
                 $("#form_asignarol").modal("show");
            }

            function verventanamodalEditar(id){
                $.ajax({
                    type:"POST",
                    url:"<?php echo URL;?>User/consulta",
                    data:{iduser:id},
                    success:function(response){
                        var xdata = response.split("#");
                        document.getElementById("Edt_iduser").value=id;
                        if(xdata[0].trim()=="A"){
                            document.getElementById("Edt_Name").value     = xdata[1].trim();
                            document.getElementById("Edt_LastName").value = xdata[2].trim();
                            document.getElementById("Edt_usuario").value  = xdata[3].trim();
                            document.getElementById("Edt_email").value    = xdata[4].trim();
                            if(xdata[5].trim()=="A"){
                                document.getElementById("combEstado").value = "1";
                            }else{
                                document.getElementById("combEstado").value = "2";
                            }
                        }
                    }
                });

                $("#form_editar").modal("show");
            }


   function envia_usuario(){
        var xnombre   = document.getElementById("Name").value.trim();
        var xlastname = document.getElementById("LastName").value.trim();
        var xusuario  = document.getElementById("usuario").value.trim();
        var xemail    = document.getElementById("email").value.trim();
        var xpwd      = document.getElementById("password").value.trim();

        if(xnombre=="" || xlastname=="" || xusuario=="" || xemail=="" || xpwd==""){
             alert("Campos Requeridos Vacios...");
        }else{
            $.ajax({
                    type:"GET",
                    url:"<?php echo URL;?>User/add",
                    data:{nombre:xnombre,
                          lastname:xlastname,
                          usuario:xusuario,
                          email:xemail,
                          pwd:xpwd},
                    success:function(response){
                        if(response.trim()!="A"){
                            if(response.trim()=="C"){
                                alert("Usuario Registrado");
                            }else{
                                alert("ERROR de Registro de Usuario");
                            }
                        }else{
                            alert("Usuario Registrado Satisfactoriamente");
                            document.getElementById("Name").value=""
                            document.getElementById("LastName").value=""
                            document.getElementById("usuario").value=""
                            document.getElementById("email").value=""
                            document.getElementById("password").value=""
                            document.getElementById("Name").focus();
                        }
                    }
                });
        }
   }


   function edita_usuario(){
    var xiduser   = document.getElementById("Edt_iduser").value.trim();
    var xnombre   = document.getElementById("Edt_Name").value.trim();
    var xlastname = document.getElementById("Edt_LastName").value.trim();
    var xusuario  = document.getElementById("Edt_usuario").value.trim();
    var xemail    = document.getElementById("Edt_email").value.trim();
    var xpwd      = document.getElementById("cambiaPwd").value.trim();
    var xestado   = document.getElementById("combEstado").value.trim();

    if(xiduser=="" || xnombre=="" || xlastname=="" || xusuario=="" || xemail=="" || xpwd=="" || xestado==""){
        alert("Campos Requeridos Vacios");
    }else{
        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>User/update",
            data:{iduser:xiduser,
                  nombre:xnombre,
                  lastname:xlastname,
                  usuario:xusuario,
                  email:xemail,
                  cambiapwd:xpwd,
                  estado:xestado},
            success:function(response){
                if(response.trim()=="1"){
                    alert("Registro Actualizado Correctamente...");
                }else{
                    alert("Error de Actualización de Datos...");
                }
            }
        });
    }
   }

   function elimina_usuario(xiduser){

        $.ajax({
            type:"POST",
            url:"<?php echo URL;?>User/delete",
            data:{iduser:xiduser},
            success:function(response){
                if(response.trim()=="1"){
                    alert("Registro Eliminado Correctamente...");
                }else{
                    alert("Error de Eliminación de Datos...");
                }
            }
        });

   }

   $(function(){
       $("ul.checktree").checktree();
    });
</script>
