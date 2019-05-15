<?php
/**
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
    
    function consulta(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){	  
            $cadena="A#".$res['id_benfep']."#".$res['nombre'];
		}else{
			$cadena="B#";
		}
		echo $cadena;
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