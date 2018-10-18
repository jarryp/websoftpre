<?php 

class Entidad extends Controllers{

	function __construct(){
		parent::__construct();
	}

	public function listado(){
		echo $this->model->cargar("*","id_entidad desc ");
	}


	public function entidadActual(){
		echo $this->model->entidadActual("descripcion","id_entidad= ".ID_ENTIDAD);	
	}


}

?>