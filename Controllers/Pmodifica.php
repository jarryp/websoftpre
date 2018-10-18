<?php 

class Pmodifica extends Controllers {
	
	function __construct(){
		parent::__construct();
	}

	function creditoa(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'creditoa');
		}else{
			header("Location:".URL);
		}
	}

	function traslado(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'traslado');
		}else{
			header("Location:".URL);
		}
	}

	function add(){
		$this->model->setIdSoportel($_REQUEST['id_soportel']);
		$this->model->setIdEspecifica($_REQUEST['id_especifica']);
		$this->model->setIdTipoModif($_REQUEST['id_tipo_modif']);
		$this->model->setMonto(floatval($_REQUEST['monto']) );
		$this->model->setIdUsuario($_REQUEST['idusuario']);

		//echo gettype($this->model->getMonto());
		//echo floatval($this->model->getMonto());

		
		if($this->model->save()){
			echo '1';
		}else{
			echo '2';	
		} 

	}

	function limpiaMod(){
		$this->model->setIdSoportel($_REQUEST['id_soportel']);
		if($this->model->limpiaMod()){
			echo "1";
		}else{
			echo "2";
		}
	}

	function lista(){
		$this->model->setId($_REQUEST['id_soportel']);
		$datos = json_decode($this->model->listaModel());
        echo "<table id='tblDetalle' class='table table-striped table-hover table-responsive table-bordered'>
    				<thead>
    					<tr>
    						<th align='center'><strong>Código</strong></th>
    						<th align='center'><strong>Dominación</strong></th>
    						<th align='center'><strong>Monto</strong></th>
    						<th align='center' width='7%'>Eliminar</th>
    					</tr>
    				</thead>
    				<tbody>";
    		$cont=1;
    		$acu_monto=0;
			foreach ($datos as $impt) {
				$acu_monto+=$impt->monto;
				echo "<tr>
						<td id='col1_$cont'> $impt->cod_especifica </td>
						<td id='col2_$cont'> $impt->nombre </td>
						<td id='col3_$cont' align='right'> $impt->monto </td>
						<td align='center'> <button type='button' class='del'>Eliminar</button> </td>
				      </tr>";
				$cont++;
			}
		echo "</tbody>
		      </table>

		      <script>

		      	document.getElementById('control').value = $cont-1;
		      	document.getElementById('total').value   = $acu_monto;

		      	$('#tblDetalle').on('click', '.del', function(){
 					var xresultado  = parseFloat(document.getElementById('total').value);
 					document.getElementById('total').value = xresultado - parseFloat($(this).parents('tr').find('td').eq(2).html() ) ;
				$(this).parents('tr').remove();
				});

				formatoTabla('tblDetalle');

		      </script>
		      ";
	}

	function listaCedentes(){
		$this->model->setId($_REQUEST['id_soportel']);
		$this->model->setIdTipoModif($_REQUEST['id_tipo_modif']);
		$datos = json_decode($this->model->listaTrasladosModel());
		echo "<table id='tblDetalle1' class='table table-striped table-hover table-responsive table-bordered'>
    				<thead>
    					<tr class='bg-warning'>
    						<td colspan='4' align='center'><strong>CUENTAS PRESUPUESTARIAS CEDENTES</strong></td>
    					</tr>
    					<tr  class='bg-warning'>
    						<th align='center'><strong>Código</strong></th>
    						<th align='center'><strong>Dominación</strong></th>
    						<th align='center'><strong>Monto</strong></th>
    						<th align='center' width='7%'>Eliminar</th>
    					</tr>
    				</thead>
    				<tbody>";

    		$cont=1;
    		$acu_monto=0;
			foreach ($datos as $impt) {
				$acu_monto+=$impt->monto;
				echo "<tr>
						<td id='col1_$cont'> $impt->cod_especifica </td>
						<td id='col2_$cont'> $impt->nombre </td>
						<td id='col3_$cont' align='right'> $impt->monto </td>
						<td align='center'> <button type='button' class='del'>Eliminar</button> </td>
				      </tr>";
				$cont++;
			}

    	echo "</tbody>
		      </table> 
		      <script>

		      	document.getElementById('controlc').value = $cont-1;
		      	document.getElementById('totalc').value   = $acu_monto;

		      	$('#tblDetalle1').on('click', '.del', function(){
 					var xresultado  = parseFloat(document.getElementById('totalc').value);
 					document.getElementById('totalc').value = xresultado - parseFloat($(this).parents('tr').find('td').eq(2).html() ) ;
				$(this).parents('tr').remove();
				});

				formatoTabla('tblDetalle1');
		      </script>  ";
	}

	function listaReceptoras(){
		$this->model->setId($_REQUEST['id_soportel']);
		$this->model->setIdTipoModif($_REQUEST['id_tipo_modif']);
		$datos = json_decode($this->model->listaTrasladosModel());
		echo "<table id='tblDetalle2' class='table table-striped table-hover table-responsive table-bordered'>
    				<thead>
    					<tr class='bg-info'>
    						<td colspan='4' align='center'><strong>CUENTAS PRESUPUESTARIAS RECEPTORAS</strong></td>
    					</tr>
    					<tr  class='bg-info'>
    						<th align='center'><strong>Código</strong></th>
    						<th align='center'><strong>Dominación</strong></th>
    						<th align='center'><strong>Monto</strong></th>
    						<th align='center' width='7%'>Eliminar</th>
    					</tr>
    				</thead>
    				<tbody>";

    		$cont=1;
    		$acu_monto=0;
			foreach ($datos as $impt) {
				$acu_monto+=$impt->monto;
				echo "<tr>
						<td id='col1_$cont'> $impt->cod_especifica </td>
						<td id='col2_$cont'> $impt->nombre </td>
						<td id='col3_$cont' align='right'> $impt->monto </td>
						<td align='center'> <button type='button' class='del'>Eliminar</button> </td>
				      </tr>";
				$cont++;
			}

    	echo "</tbody>
		      </table> 
		      <script>

		      	document.getElementById('controlr').value = $cont-1;
		      	document.getElementById('totalr').value   = $acu_monto;

		      	$('#tblDetalle2').on('click', '.del', function(){
 					var xresultado  = parseFloat(document.getElementById('totalr').value);
 					document.getElementById('totalr').value = xresultado - parseFloat($(this).parents('tr').find('td').eq(2).html() ) ;
				$(this).parents('tr').remove();
				});

				formatoTabla('tblDetalle2');
		      </script>  ";
	}





}

?>