<?php

class Entidad_model extends Conexion {
	private $tabla = "entidad";
	private $id_entidad;
	private $descripcion;
	private $observacion;

	function setIdEntidad($id_entidad){
		$this->id_entidad = $id_entidad;
	}

	function getIdEntidad(){
		return $this->id_entidad;
	}


	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setObservacion($observacion){
		$this->observacion = $observacion;
	}

	function getObservacion(){
		return $this->observacion;
	}

	function cargar($fields,$orden){
		return json_encode($this->db->select2($fields,$this->tabla,$orden));
	}

	function entidadActual($fields,$condicion){
		return json_encode($this->db->select1($fields,$this->tabla,$condicion));
	}


}

?>