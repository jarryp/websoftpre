<?php

class Principal extends Controllers {


	function __construct(){
		parent::__construct();
	}

	function principal(){
		//echo "Hola desde el Controlador Principal";
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render($this,'principal');
		}else{
			//header("Location:".URL);
			$this->view->render($this,'principal');
		}
	}


}

?>