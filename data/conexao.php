<?php
	class Conexao{
		public $conexao;

		public function __construct(){
			$host = 'localhost';
		    $db_name = 'anaju876_pdsdatabase';
		    $db_username = 'anaju876_pdsuser';
		    $db_password = 'ey29qa8xjs018wsj'; 
		    
		    $this->conexao = mysqli_connect($host, $db_username, $db_password, $db_name);
		    if(!($this->conexao)){
		     	echo "Conexao Falhada"; exit;
		   	}else{
		   	}

		}

		public function getConexao(){
			return $this->conexao;
		}


	}
	
	// $hostname="";
	// $username="";
	// $password="";
	// $dbname="anaju876_pdsdatabase";
	
	// $usertable="your_tablename";
	// $yourfield = "your_field";
	
	// mysql_connect($hostname,$username, $password) ou desconexão ("html>script language='JavaScript'>alert(“Não foi possível se conectar ao banco de dados! Tente novamente mais tarde.'),history.go(-1)/script>/html>");
	// mysql_select_db($dbname);
	
	# Verifique se o registro existe
	
// 	$query = "SELECT * FROM $usertable";
	
// 	$result = mysql_query($query);
	
// 	if($result){
// 		while($row = mysql_fetch_array($result)){
// 			$name = $row["$yourfield"];
// 			echo "Nome: ".$name."br/>";
// 		}
// 	}
 ?>