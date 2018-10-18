<?php 

class Especifica extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function especifica(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'especifica');
		}else{
			header("Location:".URL);
		}
	}

	function busqueda(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_popup($this,'busqueda');
		}else{
			header("Location:".URL);
		}
	}

	function muestraNombres(){
		$json = $this->model->muestraNombres($_REQUEST['codigo'],$_REQUEST['id_periodo']);
		$datos = json_decode($json);

		echo "<table class='table table-responsive table-striped table-hover'>
				<tr>
					<td align='center' width='8'><strong>Item</strong></td>
					<td align='center' width='14'><strong>Atributo</strong></td>
					<td align='center'><strong>Denominación</strong></td>
				</tr>";
		foreach ($datos as $nombres) {
			echo "<tr>
					<td> $nombres->orden  </td>
					<td> $nombres->atributo  </td>
					<td> $nombres->nombre  </td>
				  </tr>";
		}
		echo "</table>";
		
	}

	function consulta(){
		$this->model->setCodEspecifica($_REQUEST['cod_especifica']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){
			$cadena="A#".$res['id_especifica']."#".$res['cod_especifica']."#".$res['nombre']."#".$res['descripcion']."#".$res['montoi']."#".$res['id_fuentefinan'];
		}else{
			$cadena="B#";
		}

		echo $cadena;
	}

	function consulta2(){
		
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consulta2Model();
		$res = $res[0];
		if($res!=NULL){
        $cadena="A#".$res['id_especifica']."#".$res['cod_especifica']."#".$res['nombre']."#".$res['descripcion']."#".$res['montoi']."#".$res['id_actividad']."#".$res['id_generica']."#".$res['id_fuentefinan'];
		}else{
			$cadena = "B#";
		}

		echo $cadena;

	}

	function obtenerId(){
		$this->model->setCodEspecifica($_REQUEST['cod_especifica']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$res = $this->model->obtenerId();
		$res = $res[0];
		echo $res['id_especifica'];
	}

	function listado(){
		echo $this->model->listadoModel($_REQUEST['id_periodo']);
	}

	function lfiltro(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setCodEspecifica($_REQUEST['cod_especifica']);
		$json = json_decode($this->model->lfiltroModel());
		if($json==NULL){
			echo '<div class="alert alert-danger alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>No hay registros coincidentes</strong>
				</div>';	
		}else{
			
			echo "<div class='col-md-12'>
			      <table class='table table-concensed table-bordered table-hover' width='100%'>";
			      $cont=0;
			foreach ($json as $filtro) {
				$cont++;
				$valor=$filtro->cod_especifica;
				echo "<tr>
						<td  bgcolor='white'> ";
						?>
						  <a href="javascript:pasarcodigo('<?php echo $valor; ?>')">
						
						<?php 
						echo "   <label id='valor$cont'>$filtro->cod_especifica</label> 
						   </a>
						 </td>
						<td  bgcolor='white'> $filtro->nombre </td>
				      </tr>";
			}
			echo "
			    <!-- <tr>
				<td colspan='2' align='right'>
					<button type='button' class='btn btn-success' onclick='limpiar_arealistado()'> Contraer </button>
				</td>
		      </tr> -->
			      </table>
			      </div>";
		}
	}

	function add(){
		$this->model->setCodEspecifica($_REQUEST['cod_especifica']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setMontoi($_REQUEST['montoi']);
		$this->model->setIdFuenteFinan($_REQUEST['id_fuentefinan']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
		$this->model->setIdActividad($_REQUEST['id_actividad']);
		$this->model->setIdGenerica($_REQUEST['id_generica']);
		if($this->model->save()){
			echo '<div class="alert alert-success alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Inclusión Satisfactoria</strong>
				</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Registro no agregado</strong>
				</div>';	
		}
	}


	function update(){
		$this->model->setId($_REQUEST['id']);
		$this->model->setCodEspecifica($_REQUEST['cod_especifica']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setMontoi($_REQUEST['montoi']);
		$this->model->setIdFuenteFinan($_REQUEST['id_fuentefinan']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
		if($this->model->update()){
			echo '<div class="alert alert-success alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Actualización Satisfactoria</strong>
				</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Registro no Actualizado</strong>
				</div>';	
		}
	}

}