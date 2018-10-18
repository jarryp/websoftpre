<?php 

class Sector_model extends Conexion {

	private $tabla ="sector";
	private $id;
	private $id_periodo;
	private $cod_sector;
	private $nombre;
	private $descripcion;
	private $id_usuario;

function setId($id){
	$this->id = $id;
}

function getId(){
	return $this->id;
}

function setCodSector($cod_sector){
	$this->cod_sector = $cod_sector;
}

function getCodSector(){
	return $this->cod_sector;
}

function setNombre($nombre){
	$this->nombre = $nombre;
}

function getNombre(){
	return $this->nombre;
}

function setIdPeriodo($id_periodo){
	$this->id_periodo = $id_periodo;
}

function getIdPeriodo(){
	return $this->id_periodo;
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

function listadoModel($fields,$orden){
 return json_encode($this->db->select3($fields,$this->tabla," id_periodo=".$this->getIdPeriodo(),$orden));
}

function consultaModel(){
		$query="select * from $this->tabla where id_periodo=$this->id_periodo and cod_sector='$this->cod_sector'";	
		return $this->db->ejecutaSQL($query);
}

function consulta2Model(){
		$query="select * from $this->tabla where id_sector=$this->id";	
		return $this->db->ejecutaSQL($query);
}

function save(){
	$query="insert into $this->tabla (id_periodo,cod_sector,nombre,descripcion,id_usuario) 
	        values ($this->id_periodo,'$this->cod_sector','$this->nombre','$this->descripcion',$this->id_usuario)";
	return $this->db->ejecutaMdl($query);
}


function update(){
	$query="update sector set nombre='$this->nombre', descripcion='$this->descripcion', id_usuario=$this->id_usuario, updated_at=now() where id_sector=$this->id";
	return $this->db->ejecutaMdl($query);
}




} //fin de declaración de la clase

?>