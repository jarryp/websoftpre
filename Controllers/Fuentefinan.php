<?php

class Fuentefinan extends Controllers{


function __construct(){
		parent::__construct();
}

function index(){

		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'fuentefinan');
		}else{
			header("Location:".URL);
		}

}


function listado(){
	echo $this->model->listado($_GET['id_entidad']);
}


function cargarCmb(){
 $json = json_decode($this->model->cargarCombo("id_fuentefinan,descripcion","id_entidad=".$_REQUEST['id_entidad'],"descripcion"));
 echo "<option value='S'>-- Seleccione --</option>";

	foreach ($json as $fuentef) {
		echo "<option value='$fuentef->id_fuentefinan'> $fuentef->descripcion</option>";
	}
}


}


?>