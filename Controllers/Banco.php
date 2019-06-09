<?php

class Banco extends Controllers{

    function __construct()
    {
        parent::__construct();
    }

    function Banco(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'banco');
		}else{
			header("Location:".URL);
		}
	}



	function listado(){
        $this->model->setIdEntidad($_SESSION['id_entidad']);
		$json = $this->model->listadoModel("*","nombre");
		echo $json;
    }



    function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){	  
            $cadena="A#".$res['id_banco']."#".$res['nombre']."#".$res['descripcion'];
		}else{
			$cadena="B#";
		}
			echo $cadena;
		}


	public function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
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


	public function update(){
		$this->model->setId($_REQUEST['id']);
        $this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
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