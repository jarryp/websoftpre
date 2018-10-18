<?php 

class Generica extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function generica(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'generica');
		}else{
			header("Location:".URL);
		}
	}

	public function consulta(){
		$this->model->setIdPartida($_REQUEST['id_partida']);
		$this->model->setCodGenerica($_REQUEST['cod_generica']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){
		  $cadena="A#".$res['id_generica']."#".$res['cod_generica']."#".$res['nombre']."#".$res['descripcion'];	
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
		  $cadena="A#".$res['id_generica']."#".$res['cod_generica']."#".$res['nombre']."#".$res['descripcion']."#".$res['id_partida'];	
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function cargarCmb(){
		$json = json_decode($this->model->cargarCombo("id_generica, cod_generica, nombre ","id_partida=".$_REQUEST['id_partida'],"cod_generica"));
		echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $generica) {
			echo "<option value='$generica->id_generica'>$generica->cod_generica - $generica->nombre</option>";
		}
	}

	function listado(){
		echo $this->model->listadoModel($_REQUEST['id_periodo']);

	}

	function concatenarCodigo(){
		$json = $this->model->concatenaCodigo($_REQUEST['id_actividad'],$_REQUEST['id_partida'],$_REQUEST['id_generica']);	
		$datos = json_decode($json);
		$cadena="";
		$cont=0;
		foreach ($datos as $codigo) {
			$cont++;
			$cadena.=$codigo->codigo;
		}
		if($cont==3){
			echo "A#".$cadena;
		}else{
			echo "B#";
		}
	}

	function add(){
		$this->model->setIdPartida($_REQUEST['id_partida']);
		$this->model->setCodGenerica($_REQUEST['cod_generica']);
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
		$this->model->setIdPartida($_REQUEST['id_partida']);
		$this->model->setCodGenerica($_REQUEST['cod_generica']);
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