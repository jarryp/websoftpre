<?php 

class Cuentab extends Controllers{

    function __construct()
    {
        parent::__construct();
    }

    function Cuentab(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'cuentab');
		}else{
			header("Location:".URL);
		}
	}


	function listado(){
		$this->model->setIdEntidad($_REQUEST['id_entidad']);
		$json = $this->model->listadoModel();
		echo $json;
    }

	
	function add(){
		$this->model->setIdBanco($_REQUEST['id_banco']);
		$this->model->setIdUsoCuenta($_REQUEST['uso_cuenta']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setNumCuenta($_REQUEST['num_cuenta']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setSaldoInicial($_REQUEST['saldo_inicial']);
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
		$this->model->setId("id");
		$this->model->setIdBanco($_REQUEST['id_banco']);
		$this->model->setIdUsoCuenta($_REQUEST['uso_cuenta']);
		$this->model->setIdUser($_REQUEST['id_usuario']);
		$this->model->setNumCuenta($_REQUEST['num_cuenta']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setSaldoInicial($_REQUEST['saldo_inicial']);
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


	
}

?>