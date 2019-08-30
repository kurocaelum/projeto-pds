<?php 
include("Funcionario.php");

class Supervisor extends Funcionario{
	public $idSupervisor;
	public $setor;

	public function __construct(){
    }

	function getIdSupervisor(){
    	return $this->idSupervisor;
    }

    function getSetor(){
    	return $this->setor;
    }

    function setSetor($setor){
    	$this->setor = $setor;
    }
	
}

	
 ?>