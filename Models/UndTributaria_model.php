<?php

class UndTributaria_model extends Conexion {
	private $tabla="und_tributaria";
	private $id;
    private $denominacion;
    private $descripcion;
    private $valor;
    private $fechav;
	private $id_user;

	function setId($id){
		$this->id = $id;
	}

	function getId(){
		return $this->id;
	}
    
    function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }

    function getDenominacion(){
        return $this->denominacion;
    }

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
    }

    function setFechaV($fechav){
        $this->fechav = $fechav;
    }

    function getFechaV(){
        return $this->fechav;
    }

    function setValor($valor){
        $this->valor = $valor;
    }

    function getValor(){
        return $this->valor;
    }

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function consultaModel(){
		return $this->db->select1("id,denominacion,descripcion,valor,fechav",$this->tabla,"id=$this->id");
	}

	function listadoModel(){ 
	 $sql="select * from $this->tabla order by fechav desc ";
	 return json_encode($this->db->ejecutaSQL($sql));
	}

	function save(){
		$query="insert into $this->tabla (denominacion,descripcion,valor,fechav,id_user) 
		      values ('$this->denominacion','$this->descripcion',$this->valor,'$this->fechav',$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
        $query="update $this->tabla set descripcion  = '$this->descripcion',
                                        denominacion = '$this->denominacion',
                                        valor        =  $this->valor,
                                        fechav       = '$this->fechav',
                                        updated_at   =  now()
		        where id = $this->id ";
		return $this->db->ejecutaMdl($query);
	}

}

?>