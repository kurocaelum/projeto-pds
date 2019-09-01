<?php 

class Funcionario{
	public $idFuncionario;
   	public $nome;
   	public $telefone;
   	public $email;
   	public $idSupervisorChefe;

	public function __construct(){
    }

	function getIdFuncionario(){
    	return $this->idFuncionario;
    }

	function setIdFuncionario($idFuncionario){
    	$this->idFuncionario = $idFuncionario;
    }

	function getNome(){
    	return $this->nome;
    }
	
	function setNome($nome){
		$this->nome = $nome;
	}

	function getIdSupervisorChefe(){
    	return $this->idSupervisorChefe;
    }
	
	function setIdSupervisorChefe($idSupervisorChefe){
		$this->idSupervisorChefe = $idSupervisorChefe;
	}

	function getEmail(){
    	return $this->email;
    }
	
	function setEmail($email){
		$this->email = $email;
	}

	function getTelefone(){
    	return $this->telefone;
    }
	
	function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
}

	
 ?>