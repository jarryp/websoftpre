<?php

class Fuentefinan_model extends Conexion {
	private $tabla="fuentefinan";
	private $id;
	private $id_entidad;
	private $descripcion;
	private $id_usuario;

	function setId($id){
		$this->id = $id;
	}

	function getId(){
		return $this->id;
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

	function setIdUsuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	function getIdUsuario(){
		return $this->id_usuario;
	}

	function listado($id_entidad){
		return json_encode($this->db->select3("*",$this->tabla,"id_entidad=".$id_entidad," id_fuentefinan "));
	}

	function cargarCombo($fields,$condicion,$orden){
		return json_encode($this->db->select3($fields,$this->tabla,$condicion,$orden));
	}

}

?>