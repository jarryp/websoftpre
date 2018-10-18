<?php

class Programa extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function programas(){
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'programas');
		}else{
			header("Location:".URL);
		}
	}


	function listado(){
		$json = $this->model->listadoModel($_REQUEST['id_periodo']);
		echo $json;
	}

	function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){
		  $cadena="A#".$res['id_programa']."#".$res['cod_programa']."#".$res['id_sector']."#".$res['nombre']."#".$res['descripcion'];	
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function consulta2(){
		$this->model->setIdSector($_REQUEST['id_sector']);
		$this->model->setCodPrograma($_REQUEST['cod_programa']);
		$res = $this->model->consulta2Model();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){
		  $cadena="A#".$res['id_programa']."#".$res['cod_programa']."#".$res['id_sector']."#".$res['nombre']."#".$res['descripcion'];	
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function cargarCmb(){
		$json = json_decode($this->model->cargarCombo("id_programa,cod_programa,nombre","id_sector=".$_REQUEST['id_sector'],"cod_programa"));
		echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $programa) {
			echo "<option value='$programa->id_programa'>$programa->cod_programa - $programa->nombre</option>";
		}
	}

	function add(){
		$this->model->setIdSector($_REQUEST['id_sector']);
		$this->model->setCodPrograma($_REQUEST['cod_programa']);
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
		$this->model->setIdSector($_REQUEST['id_sector']);
		$this->model->setCodPrograma($_REQUEST['cod_programa']);
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