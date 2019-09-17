<?php 

class Funcionario{
	public $idFuncionario;
   	public $nome;
   	public $telefone;
   	public $email;
   	public $idSupervisorChefe;

	public function __construct(){
    }

	public function getIdFuncionario(){
    	return $this->idFuncionario;
    }

	public function setIdFuncionario($idFuncionario){
    	$this->idFuncionario = $idFuncionario;
    }

	public function getNome(){
    	return $this->nome;
    }
	
	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getIdSupervisorChefe(){
    	return $this->idSupervisorChefe;
    }
	
	public function setIdSupervisorChefe($idSupervisorChefe){
		$this->idSupervisorChefe = $idSupervisorChefe;
	}

	public function getEmail(){
    	return $this->email;
    }
	
	public function setEmail($email){
		$this->email = $email;
	}

	public function getTelefone(){
    	return $this->telefone;
    }
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
}

	
 ?>