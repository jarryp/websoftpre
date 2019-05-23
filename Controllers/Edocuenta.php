<?php 

class Edocuenta extends Controllers{

    function __construct()
    {
        parent::__construct();
    }

    function Edocuenta(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'edocuenta');
		}else{
			header("Location:".URL);
		}
	}

	function listado(){
		echo $this->model->listadoModel($_REQUEST['id_entidad']);
    }


    function add(){
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setIdCuentab($_REQUEST['id_cuentab']);
		$this->model->setAgno($_REQUEST['agno']);
		$this->model->setMes($_REQUEST['mes']);
		$this->model->setSaldo($_REQUEST['saldo']);
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
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setIdCuentab($_REQUEST['id_cuentab']);
		$this->model->setAgno($_REQUEST['agno']);
		$this->model->setMes($_REQUEST['mes']);
		$this->model->setSaldo($_REQUEST['saldo']);
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