<?php 
class UsoVehiculo_model extends Conexion {
    private $tabla="uso_vehiculo";
    private $id;
    private $id_entidad;
    private $descripcion;
    private $id_user;

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

    function setIdUser($id_user){
        $this->id_user = $id_user;
    }

    function getIdUser(){
        return $this->id_user;
    }

    function consultaModel(){
	 return $this->db->select1(" id_uso_vehiculo, descripcion",$this->tabla,"id_uso_vehiculo=$this->id");
    }
    
    function listadoModel($id_entidad){ 
        $sql="select id_uso_vehiculo, descripcion 
              from $this->tabla 
              where id_entidad=$id_entidad 
              order by descripcion ";
       return json_encode($this->db->ejecutaSQL($sql));
    }

    function save(){
		$query="insert into $this->tabla (id_entidad,descripcion,id_user) 
		      values ($this->id_entidad,'$this->descripcion',$this->id_user)";
		return $this->db->ejecutaMdl($query);
    }
    
    function update(){
		$query="update $this->tabla set descripcion = '$this->descripcion',
                                        updated_at  = now()
		        where id_uso_vehiculo=$this->id ";
		return $this->db->ejecutaMdl($query);
	}

}
?>