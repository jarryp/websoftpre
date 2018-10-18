<?php 


class Conexion extends Controllers{
	function __construct(){
		$this->db = new QueryManager(DB_SERVER,DB_PORT,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_DATABASE);
	}


}

?>