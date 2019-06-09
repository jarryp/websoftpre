<?php

class Periodop_model extends Conexion {
	private $tabla="periodo";
	private $id_periodo;
	private $id_entidad;
	private $descripcion;
	private $observacion;

	function setIdPeriodo($id_periodo){
		$this->id_periodo = $id_periodo;
	}

	function getIdPeriodo(){
		return $this->id_periodo;
	}

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

	function listado($id_entidad){
		return json_encode($this->db->select3("*",$this->tabla,"id_entidad=".$id_entidad," descripcion desc "));
	}


	function periodoActual($fields,$condicion){
		return json_encode($this->db->select1($fields,$this->tabla,$condicion));
	}

	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_periodo=$this->id_periodo");
	}


}

?>