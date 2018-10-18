<?php 

class Obra extends Controllers {


	function obras(){
		$UserName = Session::getSession("usuario");

		if($UserName!=""){
			$this->view->render_section($this,'obras');
		}else{
			header("Location:".URL);
		}
	}

	function listado(){
		$json = $this->model->listadoModel($_REQUEST['id_periodo']);
		echo $json;
	}

	function consulta(){

		$res=NULL;
		$this->model->setIdPrograma($_REQUEST['id_programa']);
		$this->model->setCodObra($_REQUEST['cod_obra']);
		$res = $this->model->consultaModel();
		$res = $res[0];
		if($res!=NULL){
			$cadena="A#".$res['id_obra']."#".$res['nombre']."#".$res['descripcion'];
		}else{
			$cadena="B#";
		}
 		echo $cadena;
	}

	function consulta2(){

		$res=NULL;
		$this->model->setId($_REQUEST['id']);
		$res = $this->model->consulta2Model();
		$res = $res[0];
		if($res!=NULL){
			$cadena="A#".$res['id_obra']."#".$res['cod_obra']."#".$res['obra']."#".$res['descripcion']."#".$res['id_sector']."#".$res['id_programa'];
		}else{
			$cadena="B#";
		}
 		echo $cadena;
	}

	function cargarCmb(){
		$json = json_decode($this->model->cargarCombo("id_obra,cod_obra,nombre","id_programa=".$_REQUEST['id_programa'],"cod_obra"));
		echo "<option value='S'>-- Seleccione --</option>";
		foreach ($json as $obra) {
			echo "<option value='$obra->id_obra'>$obra->cod_obra - $obra->nombre</option>";
		}
	}

	function add(){
		$this->model->setIdPrograma($_REQUEST['id_programa']);
		$this->model->setCodObra($_REQUEST['cod_obra']);
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
		$this->model->setIdPrograma($_REQUEST['id_programa']);
		$this->model->setCodObra($_REQUEST['cod_obra']);
		$this->model->setNombre($_REQUEST['nombre']);
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
  					<strong>Registro no Actualizado</strong>
				</div>';	
		}
	}

}

?>