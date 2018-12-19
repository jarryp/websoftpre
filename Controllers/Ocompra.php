<?php 

header('Access-Control-Allow-Origin: *');
class Ocompra extends Controllers {

	function __construct(){
		parent::__construct();
	}

	public function ocompra(){
		//echo "Hola desde el Controlador de usarios";
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'ocompra');
		}else{
			header("Location:".URL);
		}
	}

}

?>