<?php

class Juridico extends Controllers{

	function __construct(){
		parent::__construct();
	}

	function juridico(){
	$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'juridico');
		}else{
			header("Location:".URL);
		}
	}

	public function listado(){
		$this->model->setIdEntidad($_SESSION['id_entidad']);
		$json = $this->model->listadoModel("*","nombre");
		echo $json;
	}

	
	public function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		$cadena="";

		if($res!=NULL){

		  $cadena="A#".$res['rif']."#".$res["nombre"]."#".$res["telefono"]."#".$res["email"]."#".$res["direccion"];	

		}else{
			$cadena="B#";
		}

		echo $cadena;
	}

	public function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUsuario($_REQUEST['id_usuario']);
		$this->model->setRif($_REQUEST['rif']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setTelefono($_REQUEST['telefono']);
		$this->model->setEmail($_REQUEST['email']);
		$this->model->setDireccion($_REQUEST['direccion']);
		echo $this->model->save();
	}

	public function update(){
		$this->model->setId($_REQUEST['id']);
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUsuario($_REQUEST['id_usuario']);
		$this->model->setRif($_REQUEST['rif']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setTelefono($_REQUEST['telefono']);
		$this->model->setEmail($_REQUEST['email']);
		$this->model->setDireccion($_REQUEST['direccion']);
		echo $this->model->update();
	}





}

?>