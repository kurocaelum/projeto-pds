<?php 
include("Funcionario.php");

class Supervisor extends Funcionario{
	public $idSupervisor = "";

	public function __construct($idSupervisor, $idFuncionario){
        $this->idSupervisor = $idSupervisor;
    }

	function getIdSupervisor(){
    	return $this->idSupervisor;
    }
	
}

	
 ?>