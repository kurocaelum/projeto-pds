<?php 
include("Pessoa.php");

class Funcionario extends Pessoa{
	private $idFuncionario = "";

	public function __construct(){
    }

	function getIdFuncionario(){
    	return $this->idFuncionario;
    }

	function setIdFuncionario($idFuncionario){
    	$this->idFuncionario = $idFuncionario;
    }

	
}

	
 ?>