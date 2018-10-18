<?php 


Class QueryManager{
	private $link;
	function __construct($HOST,$PORT,$USER,$PASS,$NAME){

		 $this->link = pg_connect("host=$HOST port=$PORT dbname=$NAME user=$USER password=$PASS");
		if(!$this->link){
			printf("Fallo de Conexión: %s\n".pg_last_error());
			exit();
		}

	}

	function select1($columnas,$tablas,$condicion){
		$query= "SELECT ".$columnas." FROM ".$tablas." WHERE ".$condicion.";";
		$result = pg_query($query);
		if(pg_num_rows($result) > 0){
			while($row = pg_fetch_assoc($result)){
				$response[] = $row;
			}
			return $response;
		}
	}


	function select2($columnas,$tablas,$orden){
		$query="SELECT ".$columnas." FROM ".$tablas." ORDER BY ".$orden.";";
		$result = pg_query($query);
		if(pg_num_rows($result) > 0){
			while($row = pg_fetch_assoc($result)){
				$response[] = $row;
			}
			return $response;	
		}

	}


	function select3($columnas,$tablas,$condicion,$orden){
		$query="SELECT ".$columnas." FROM ".$tablas." WHERE ".$condicion." ORDER BY ".$orden.";";
		$result = pg_query($query);
		if(pg_num_rows($result) > 0){
			while($row = pg_fetch_assoc($result)){
				$response[] = $row;
			}
			return $response;	
		}

	}


	function insert($table,$columns){
		$columnas = null;
		$datos    = null;
		foreach ($columns as $key => $value) {
				$columnas .=$key.',';
				$datos    .='"'.$value.'",';
		}

		//quitar ultima coma de las variables columnas y datos

		$columnas = substr($columnas,0,-1);
		$datos    = substr($datos, 0,-1);


		$stmt     = "insert into ".$table." (".$columnas.") values (".$datos.")";
		$result   = $this->link->query($stmt);

	}


	function ejecutaMdl($query){
		if(pg_query($query)){
			return true;
		}else{
			return false;
		}
	}

	function ejecutaSQL($query){
		$result = pg_query($query);
		if(pg_num_rows($result) > 0){
			while($row = pg_fetch_assoc($result)){
				$response[] = $row;
			}
			return $response;	
		}
	}


	function existe($tabla,$campo,$valor){
		$query="select * from ".$tabla." where ".$campo."='".$valor."';";
		$result=pg_query($query);
		if(pg_num_rows($result)>0){
			return true;
		}else{
			return false;
		}
	}


	function consulta($tabla,$campos,$filtro,$valor){
		$query="select ".$campos." from ".$tabla." where ".$filtro."='".$valor."';";
		$result=pg_query($query);

		if(pg_num_rows($result) > 0){
			while($row = pg_fetch_assoc($result)){
				$response[] = $row;
			}
			return $response;	
		}
	}


	function __destroy(){
		pg_close($this->link);
	}



}

?>