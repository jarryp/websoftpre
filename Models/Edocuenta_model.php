<?php 

class Edocuenta_model extends Conexion {
	private $tabla="estado_cuenta";
	private $id;
	private $id_cuentab;
	private $agno;
	private $mes;
	private $saldo;
	private $id_user;

	function setId($id){
		$this->id = $id;
	}

	function getId(){
		return $this->id;
	}

	function setIdCuentab($id_cuentab){
		$this->id_cuentab = $id_cuentab;
	}

	function getIdCuentab(){
		return $this->id_cuentab;
	}

	function setAgno($agno){
		$this->agno = $agno;
	}

	function getAgno(){
		return $this->agno;
	}

	function setMes($mes){
		$this->mes = $mes;
	}

	function getMes(){
		return $this->mes;
	}

	function setSaldo($saldo){
		$this->saldo = $saldo;
	}

	function getSaldo(){
		return $this->saldo;
	}

	function setIdUser($id_user){
		$this->id_user = $id_user;
	}

	function getIdUser(){
		return $this->id_user;
	}

    function listadoModel($id_entidad){ 
	 $sql="select e.id_estado_cuenta, 
  		    e.id_cuentab ,
       		b.nombre as banco,
       		c.num_cuenta,
       		e.agno, e.mes,
       		case 
        		when e.mes=1 then 'Enero'
        		when e.mes=2 then 'Febrero'
        		when e.mes=3 then 'Marzo'
        		when e.mes=4 then 'Abril'
        		when e.mes=5 then 'Mayo'
        		when e.mes=6 then 'Junio'
        		when e.mes=7 then 'Julio'
        		when e.mes=8 then 'Agosto'
        		when e.mes=9 then 'Septiembre'
        		when e.mes=10 then 'Octubre'
        		when e.mes=11 then 'Noviembre'
        		when e.mes=12 then 'Diciembre'
       		end as nom_mes ,
       		e.saldo 
			from estado_cuenta e
			left join cuentasb c on c.id_cuentab = e.id_cuentab 
			left join banco b on b.id_banco = c.id_banco 
			where b.id_entidad = $id_entidad 
			order by banco, e.agno, e.mes  ";
	return json_encode($this->db->ejecutaSQL($sql));
	}

	function consultaModel(){
		return $this->db->select1("*",$this->tabla,"id_estado_cuenta=$this->id");
	}

	function save(){
		$query="insert into $this->tabla (id_cuentab,agno,mes,saldo,id_user) 
		      values ($this->id_cuentab,$this->agno,$this->mes,$this->saldo,$this->id_user)";
		return $this->db->ejecutaMdl($query);
	}

	function update(){
		$query="update $this->tabla set id_cuentab  = $this->id_cuentab,
										agno        = $this->agno, 
                                        mes         = $this->mes, 
                                        saldo       = $this->saldo,
                                        updated_at  = now()
		        where id_estado_cuenta=$this->id ";
		return $this->db->ejecutaMdl($query);
	}



}

?>