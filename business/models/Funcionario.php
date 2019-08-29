<?php 
include("Pessoa.php");

class Funcionario extends Pessoa{
	private $idFuncionario = "";

	public function __construct($idFuncionario){
        $this->idFuncionario = $idFuncionario;
    }

	function getIdFuncionario(){
    	return $this->idFuncionario;
    }
	
}

	
 ?>