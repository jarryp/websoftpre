<?php

class Pnatural extends Controllers {

	function __construct(){
		parent::__construct();
	}

	public function pnatural(){
		//echo "Hola desde el Controlador de usarios";
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'pnatural');
		}else{
			header("Location:".URL);
		}
	}


	public function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";

		if($res!=NULL){

		  $cadena="A#".$res['cedula']."#".$res["nombres"]."#".$res["apellidos"]."#".$res["telefono"]."#".$res["email"]."#".$res["direccion"];	

		}else{
			$cadena="B#";
		}

		echo $cadena;
	}


	public function listado(){
		$this->model->setIdEntidad($_SESSION['id_entidad']);
		$json = $this->model->listadoModel("*","apellidos, nombres ");
		echo $json;
	}

	public function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUsuario($_REQUEST['id_usuario']);
		$this->model->setCedula($_REQUEST['cedula']);
		$this->model->setNombres($_REQUEST['nombres']);
		$this->model->setApellidos($_REQUEST['apellidos']);
		$this->model->setTelefono($_REQUEST['telefono']);
		$this->model->setEmail($_REQUEST['email']);
		$this->model->setDireccion($_REQUEST['direccion']);
		echo $this->model->save();
	}

	public function update(){
		$this->model->setId($_REQUEST['id']);
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUsuario($_REQUEST['id_usuario']);
		$this->model->setCedula($_REQUEST['cedula']);
		$this->model->setNombres($_REQUEST['nombres']);
		$this->model->setApellidos($_REQUEST['apellidos']);
		$this->model->setTelefono($_REQUEST['telefono']);
		$this->model->setEmail($_REQUEST['email']);
		$this->model->setDireccion($_REQUEST['direccion']);
		echo $this->model->update();
	}


}

?>