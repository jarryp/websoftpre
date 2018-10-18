<?php

class Obra_model extends Conexion {
	private $tabla="obra";
	private $id;
	private $id_programa;
	private $cod_obra;
	private $nombre;
	private $descripcion;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdPrograma($id_programa){$this->id_programa = $id_programa;}
	function getIdPrograma(){ return $this->id_programa; }
	function setCodObra($cod_obra){ $this->cod_obra = $cod_obra; }
	function getCodObra(){ return $this->cod_obra; }
	function setNombre($nombre){ $this->nombre = $nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	function listadoModel($id_periodo){
		$query="select pr.id_periodo,
				       pr.descripcion as periodo,
       				   s.id_sector,
       				   s.cod_sector,
       				   s.nombre as sector,
       				   p.id_programa,
       				   p.cod_programa,
       				   p.nombre as programa , 
       				   o.id_obra ,
       				   o.cod_obra, 
       				   o.nombre as obra 
				from obra o 
				left join programa p on p.id_programa = o.id_programa 
				left join sector s on s.id_sector = p.id_sector 
				left join periodo pr on pr.id_periodo = s.id_periodo 
				where pr.id_periodo = $id_periodo 
				order by cod_sector, cod_programa , cod_obra " ;
		return json_encode($this->db->ejecutaSQL($query));
	}

	function consultaModel(){
		$query="select * from $this->tabla 
		        where id_programa=$this->id_programa and 
		              cod_obra='$this->cod_obra'";	
		return $this->db->ejecutaSQL($query);
	}

	function consulta2Model(){
		$query="select pr.id_periodo,
				       pr.descripcion as periodo,
       				   s.id_sector,
       				   s.cod_sector,
       				   s.nombre as sector,
       				   p.id_programa,
       				   p.cod_programa,
       				   p.nombre as programa , 
       				   o.id_obra ,
       				   o.cod_obra, 
       				   o.nombre as obra ,
       				   o.descripcion
				from obra o 
				left join programa p on p.id_programa = o.id_programa 
				left join sector s on s.id_sector = p.id_sector 
				left join periodo pr on pr.id_periodo = s.id_periodo 
				where o.id_obra = $this->id
				order by cod_sector, cod_programa , cod_obra " ;
		return $this->db->ejecutaSQL($query);
	}

	function cargarCombo($fields,$condicion,$orden){
		return json_encode($this->db->select3($fields,$this->tabla,$condicion,$orden));
	}

	function save(){
		$query="insert into obra(id_programa,cod_obra,nombre,descripcion,id_usuario) 
		values ($this->id_programa,'$this->cod_obra','$this->nombre','$this->descripcion',$this->id_usuario);";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update obra set nombre='$this->nombre', descripcion='$this->descripcion', id_usuario=$this->id_usuario, updated_at=now() 
		    where id_obra=$this->id";
		return $this->db->ejecutaMdl($query);
	}


}

?>