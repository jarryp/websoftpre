<?php

class Soportel_model extends Conexion {
	private $tabla = "soportel";
	private $id;
	private $id_periodo;
	private $fecha;
	private $id_modificacion;
	private $cod_soportel;
	private $descripcion;
	private $id_usuario;


	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }
	function setIdPeriodo($id_periodo){ $this->id_periodo = $id_periodo; }
	function getIdPeriodo(){ return $this->id_periodo; }
	function setFecha($fecha){ $this->fecha = $fecha; }
	function getFecha(){ return $this->fecha; }
	function setIdModificacion($id_modificacion){ $this->id_modificacion = $id_modificacion; }
	function getIdModificacion(){ return $this->id_modificacion; }
	function setCodSoportel($cod_soportel){ $this->cod_soportel = $cod_soportel; }
	function getCodSoportel(){ return $this->cod_soportel; }
	function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	function getDescripcion(){ return $this->descripcion; }
	function setIdUsuario($id_usuario){ $this->id_usuario = $id_usuario; }
	function getIdUsuario(){ return $this->id_usuario; }


	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"cod_soportel='$this->cod_soportel' and id_periodo='$this->id_periodo'");
	}

	function consulta2Model(){
		return $this->db->select1("*",$this->tabla,"id_soportel='$this->id' ");
	}

	function listadoModel(){
		$query="select id_soportel , fecha , cod_soportel, 
       			case id_modificacion 
         			when 1 then 'Credito Adicional' 
         			when 2 then 'Traslado' 
         			when 3 then 'Reduccion'
       			end as tipo, 
       			descripcion 
				from soportel 
				where id_periodo = $this->id_periodo  
				order by fecha, cod_soportel ";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function lcredreducModel(){
		$query="select id_soportel , fecha , cod_soportel, 
       			case id_modificacion 
         			when 1 then 'Credito Adicional' 
         			when 2 then 'Traslado' 
         			when 3 then 'Reduccion'
       			end as tipo, 
       			descripcion 
				from soportel 
				where id_periodo = $this->id_periodo and 
				      id_modificacion in(1,3)
				order by fecha, cod_soportel ";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function ltrasladosModel(){
		$query="select id_soportel , fecha , cod_soportel, 
       			case id_modificacion 
         			when 1 then 'Credito Adicional' 
         			when 2 then 'Traslado' 
         			when 3 then 'Reduccion'
       			end as tipo, 
       			descripcion 
				from soportel 
				where id_periodo = $this->id_periodo and 
				      id_modificacion in(2)
				order by fecha, cod_soportel ";
		return json_encode($this->db->ejecutaSQL($query));
	}

	function save(){
		$query="insert into soportel (id_periodo,fecha,id_modificacion,cod_soportel,descripcion,id_usuario) values 
		    ('$this->id_periodo','$this->fecha','$this->id_modificacion','$this->cod_soportel','$this->descripcion','$this->id_usuario') ;";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update soportel set fecha='$this->fecha', id_modificacion='$this->id_modificacion', 
		                            descripcion = '$this->descripcion', updated_at = now() 
		        where id_soportel = '$this->id' ; ";
		return $this->db->ejecutaMdl($query);
	}


}

?>