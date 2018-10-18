<?php

class Interno extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function interno(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'interno');
		}else{
			header("Location:".URL);
		}
	}


	public function listado(){
		$this->model->setIdEntidad($_SESSION['id_entidad']);
		$json = $this->model->listadoModel("*","descripcion");
		echo $json;
	}

	public function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";
		if($res!=NULL){

		  $cadena="A#".$res['descripcion'];	

		}else{
			$cadena="B#";
		}
		echo $cadena;
	}


	public function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		echo $this->model->save();
	}

	public function update(){
		$this->model->setId($_REQUEST['id']);
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		echo $this->model->update();
	}


}

?>