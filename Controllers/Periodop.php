<?php
header('Access-Control-Allow-Origin: *');

class Periodop extends Controllers{


	function __construct(){
		parent::__construct();
	}

	function index(){
	$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'index');
		}else{
			header("Location:".URL);
		}
	}

	function listado(){
		echo $this->model->listado($_GET['id_entidad']);
	}

	function cargarCombo(){
		$json = $this->model->listado($_GET['id_entidad']);
		$datos = json_decode($json);
		    echo "<option value='S'>Seleccione...</option>";
		foreach($datos as $lperiodop){
			echo "<option value='$lperiodop->id_periodo'>$lperiodop->descripcion</option>";
		}
	}

	function periodoActual(){
		echo $this->model->periodoActual("descripcion","id_periodo= ".$_REQUEST['id_periodo']);	
	}

}

?>