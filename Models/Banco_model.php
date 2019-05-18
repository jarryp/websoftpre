<?php
class Banco_model extends Conexion {
	private $tabla="banco";
	private $id;
	private $id_entidad;
	private $nombre;
	private $descripcion;
	private $id_user;

	function setId($id){
		$this->id=$id;
	}

	function getId(){
		return $this->id;
	}

	function setIdEntidad($id_entidad){
		$this->id_entidad=$id_entidad;
	}

	function getIdEntidad(){
		return $this->id_entidad;
	}

	function setNombre($nombre){
		$this->nombre = $nombre;
	}

	function getNombre(){
		return $this->nombre;
	}

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function listadoModel($fields,$orden){ 
	return json_encode($this->db->select3($fields,$this->tabla," id_entidad=".ID_ENTIDAD,$orden));
	}

	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_banco=$this->id");
	}

	function save(){
		$query="insert into $this->tabla (id_entidad,nombre,descripcion,id_user) 
		      values ($this->id_entidad,'$this->nombre','$this->descripcion',$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}
    
    function update(){
		$query="update $this->tabla set nombre      = '$this->nombre', 
                                        id_user     = $this->id_user, 
                                        descripcion = '$this->descripcion',
                                        updated_at  = now()
		        where id_banco=$this->id ";
		return $this->db->ejecutaMdl($query);
	}


}