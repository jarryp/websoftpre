<?php
/**
 * Created by PhpStorm.
 * User: jarryp
 * Date: 14/05/19
 * Time: 12:23 AM
 */

class BenfEp extends Controllers{

    function __construct()
    {
        parent::__construct();
    }
    
    function BenfEp(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'benfep');
		}else{
			header("Location:".URL);
		}
	}
    
    function listado(){
        $this->model->setIdEntidad($_SESSION['id_entidad']);
		$json = $this->model->listadoModel("*","nombre");
		echo $json;
    }
    
    public function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setNombre($_REQUEST['nombre']);
		echo $this->model->save();
	}
    
}

?>