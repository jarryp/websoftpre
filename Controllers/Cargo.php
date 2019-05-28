<?php

class Cargo extends Controllers {

	function __construct(){
		parent::__construct();
	}

	function cargo(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'cargo');
		}else{
			header("Location:".URL);
		}
	}

	function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){	  
            $cadena="A#".$res['id_cargo']."#".$res['descripcion']."#".$res['estatus']."#".$res['confianza'];
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function listado(){
		echo $this->model->listadoModel($_REQUEST['id_entidad']);
    }

	function add(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setConfianza($_REQUEST['confianza']);
		$this->model->setEstatus($_REQUEST['estatus']);
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

	function update(){
		$this->model->setId($_REQUEST['id']);
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setConfianza($_REQUEST['confianza']);
		$this->model->setEstatus($_REQUEST['estatus']);
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