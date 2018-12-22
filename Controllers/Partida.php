<?php 

class Partida extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function partida(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'partida');
		}else{
			header("Location:".URL);
		}
	}

	public function consulta(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setCodPartida($_REQUEST['cod_partida']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){
		  $cadena="A#".$res['id_partida']."#".$res['nombre']."#".$res['descripcion'];	
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	public function consulta2(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consulta2Model();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){
		$cadena="A#".$res['id_partida']."#".$res['nombre']."#".$res['descripcion']."#".$res['cod_partida'];	
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function listado(){
		echo $this->model->listadoModel($_REQUEST['id_periodo']);
	}

	function listado2(){
		echo $this->model->listado2Model($_REQUEST['id_periodo']);
	}

	function cargarCmb(){
		$json = json_decode($this->model->cargarCombo("id_partida,cod_partida,nombre","id_periodo=".$_REQUEST['id_periodo'],"cod_partida"));
		echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $partida) {
			echo "<option value='$partida->id_partida'>$partida->cod_partida - $partida->nombre</option>";
		}
	}

	function add(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setCodPartida($_REQUEST['cod_partida']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
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
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setCodPartida($_REQUEST['cod_partida']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
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

?>