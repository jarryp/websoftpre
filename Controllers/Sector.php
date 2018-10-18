<?php 

class Sector extends Controllers{

	function __construct(){
		parent::__construct();
	}

	
	function sector(){
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'sector');
		}else{
			header("Location:".URL);
		}
	}

    function listado(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$json = $this->model->listadoModel("*","cod_sector");
		echo $json;
	}

	function consulta(){
		$this->model->setCodSector($_REQUEST['cod_sector']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$res = $this->model->consultaModel();

		$res = $res[0];
		$cadena="";

		if($res!=NULL){

			$cadena="A#".$res['nombre']."#".$res['descripcion']."#".$res['id_sector'];	

		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function consulta2(){
		$this->model->setId($_REQUEST['id_sector']);
		$res = $this->model->consulta2Model();

		$res = $res[0];
		$cadena="";

		if($res!=NULL){

			$cadena="A#".$res['cod_sector']."#".$res['nombre']."#".$res['descripcion'];	

		}else{
			$cadena="B#";
		}
		echo $cadena;
	}


	function add(){
		$this->model->setCodSector($_REQUEST['cod_sector']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
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
		$this->model->setCodSector($_REQUEST['cod_sector']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setNombre($_REQUEST['nombre']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
		if($this->model->update()){
			echo '<div class="alert alert-success alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Actualización procesada Satisfactoriamente</strong>
				</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Registro no actualizado</strong>
				</div>';	
		}
	}


}

?>