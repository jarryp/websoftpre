<?php
class Cuentab_model extends Conexion {
	private $tabla="cuentasb";
	private $id;
	private $id_banco;
	private $num_cuenta;
	private $saldo_inicial;
	private $descripcion;
	private $id_uso_cuenta;
	private $id_user;
	private $id_entidad;

	function setId($id){
		$this->id = $id;
	}

	function getId(){
		return $this->id;
	}

	function setIdBanco($id_banco){
		$this->id_banco = $id_banco;
	}

	function getIdBanco(){
		return $this->id_banco;
	}

	function setNumCuenta($num_cuenta){
		$this->num_cuenta = $num_cuenta;
	}

	function getNumCuenta(){
		return $this->num_cuenta;
	}

	function setSaldoInicial($saldo_inicial){
		$this->saldo_inicial = $saldo_inicial;
	}

	function getSaldoInicial(){
		return $this->saldo_inicial;
	}

	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setIdUsoCuenta($id_uso_cuenta){
		$this->id_uso_cuenta = $id_uso_cuenta;
	}

	function getIdUsoCuenta(){
		return $this->id_uso_cuenta;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

	function setIdEntidad($id_entidad){
		$this->id_entidad = $id_entidad;
	}

	function getIdEntidad(){
		return $this->id_entidad;
	}

	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_cuentab=$this->id");
	}

	function listadoModel(){ 
		$sql="select c.id_cuentab, c.id_banco,
       			b.nombre as banco, 
       			case 
        			when id_uso_cuenta=1 then 'Situado Constitucional'
        			when id_uso_cuenta=2 then 'Situado Coordinado'
        			when id_uso_cuenta=3 then 'Ingresos Propios'
        			when id_uso_cuenta=4 then 'Fondos Especiales'
        			when id_uso_cuenta=5 then 'Fondos de Terceros'
       			end as uso_cuenta ,
       			c.num_cuenta,
       			c.descripcion 
				from cuentasb c 
				left join banco b on b.id_banco = c.id_banco 
				where b.id_entidad =  ".$this->getIdEntidad();
	return json_encode($this->db->ejecutaSQL($sql));
	}


	function save(){
		$query="insert into $this->tabla (id_banco,id_uso_cuenta,num_cuenta,descripcion,saldo_inicial,id_user) 
		      values ($this->id_banco,$this->id_uso_cuenta,'$this->num_cuenta','$this->descripcion',$this->saldo_inicial,$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}
    
    function update(){
		$query="update $this->tabla set id_banco      = $this->id_banco,
										id_uso_cuenta = $this->id_uso_cuenta,
                                        id_user       = $this->id_user, 
                                        num_cuenta    = '$this->num_cuenta',
                                        descripcion   = '$this->descripcion',
                                        saldo_inicial = $this->saldo_inicial,
                                        updated_at    = now()
		        where id_cuentab=$this->id ";
		return $this->db->ejecutaMdl($query);
	}



}