<?php 
include_once("Funcionario.php");

class Supervisor extends Funcionario{
	public $idSupervisor;
	public $setor;
    public $funcionario;
    // public $funcionariosAdministrados;

	public function __construct(){
        // $this->funcionariosAdministrados = [];
    }

	function getIdSupervisor(){
    	return $this->idSupervisor;
    }


    function setIdSupervisor($idSupervisor){
        $this->idSupervisor = $idSupervisor;
    }

    function getSetor(){
    	return $this->setor;
    }

    function setSetor($setor){
    	$this->setor = $setor;
    }

    function getFuncionario(){
        return $this->funcionario;
    }

    function setFuncionario($funcionario){
        $this->funcionario = $funcionario;
    }

    // function setFuncionariosAdministrados($funcionariosAdministrados){
    //     $this->funcionariosAdministrados = $funcionariosAdministrados; 
    // }

    // function getFuncionariosAdministrados(){
    //     return $this->funcionariosAdministrados; 
    // }


}

	
 ?>