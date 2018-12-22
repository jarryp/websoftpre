<?php 

class Partida_model extends Conexion {
	private $tabla ="partida";
	private $id;
	private $id_periodo;
	private $cod_partida;
	private $nombre;
	private $descripcion;
	private $id_usuario;

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdPeriodo($id_periodo){ $this->id_periodo = $id_periodo; }
	function getIdPeriodo(){ return $this->id_periodo; }
	function setCodPartida($cod_partida){ $this->cod_partida = $cod_partida; }
	function getCodPartida(){ return $this->cod_partida; }
	function setNombre($nombre){ $this->nombre=$nombre; }
	function getNombre(){ return $this->nombre; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }

	
	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_periodo=$this->id_periodo and cod_partida='$this->cod_partida'");
	}

	function consulta2Model(){
		return $this->db->select1("*",$this->tabla,"id_partida=$this->id");
	}

	function listadoModel($id_periodo){
		$query="select * from partida where id_periodo=".$id_periodo." order by cod_partida ";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function listado2Model($id_periodo){
		$query="select cod_partida, cod_partida || ' - ' || nombre as descripcion  
				from partida 
				where id_periodo = ".$id_periodo." order by cod_partida";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function cargarCombo($fields,$condicion,$orden){
		return json_encode($this->db->select3($fields,$this->tabla,$condicion,$orden));
	}

	function save(){
		$query="insert into partida(cod_partida,nombre,descripcion,id_usuario,id_periodo) 
		      values ('$this->cod_partida','$this->nombre','$this->descripcion',$this->id_usuario,$this->id_periodo)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update partida set cod_partida='$this->cod_partida', nombre='$this->nombre',
		                           descripcion='$this->descripcion', id_usuario=$this->id_usuario 
		        where id_partida=$this->id ";
		return $this->db->ejecutaMdl($query);
	}
}

?>