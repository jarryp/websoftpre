<?php 

class Soportel extends Controllers {
	
	function __construct(){
		parent::__construct();
	}

	function soportel(){
		$UserName = Session::getSession("usuario");
		if($UserName!=""){
			$this->view->render_section($this,'soportel');
		}else{
			header("Location:".URL);
		}
	}

	function consulta(){
		$this->model->setCodSoportel($_REQUEST['cod_soportel']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){
			$cadena="A#".$res['id_soportel']."#".$res['cod_soportel']."#".$res['fecha']."#".$res['id_modificacion']."#".$res['descripcion'];
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function consulta2(){
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consulta2Model();
		$res = $res[0];
		if($res!=NULL){
			$cadena="A#".$res['id_soportel']."#".$res['cod_soportel']."#".$res['fecha']."#".$res['id_modificacion']."#".$res['descripcion'];
		}else{
			$cadena="B#";
		}
		echo $cadena;
	}

	function listado(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		echo $this->model->listadoModel();
	}

	function cargar_credreduc(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$json = json_decode($this->model->lcredreducModel());

		   echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $list) {
			echo "<option value='$list->id_soportel'> $list->cod_soportel : $list->fecha : $list->tipo   </option>";
		}
	}

	function cargar_traslados(){
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$json = json_decode($this->model->ltrasladosModel());

		   echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $list) {
			echo "<option value='$list->id_soportel'> $list->cod_soportel : $list->fecha : $list->tipo   </option>";
		}
	}

	function add(){
		$this->model->setCodSoportel($_REQUEST['codigo']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setFecha($_REQUEST['fecha']);
		$this->model->setIdModificacion($_REQUEST['id_modificacion']);
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
		$this->model->setId($_REQUEST['id']);
		$this->model->setCodSoportel($_REQUEST['codigo']);
		$this->model->setIdPeriodo($_REQUEST['id_periodo']);
		$this->model->setFecha($_REQUEST['fecha']);
		$this->model->setIdModificacion($_REQUEST['id_modificacion']);
		$this->model->setDescripcion($_REQUEST['descripcion']);
		$this->model->setIdUsuario($_REQUEST['idusuario']);
		if($this->model->update()){
			echo '<div class="alert alert-success alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  					<strong>Actualización Satisfactoria</strong>
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