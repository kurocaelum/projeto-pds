<?php

class Pessoa{
	protected $nome = "";
	protected $idPessoa = "";

	public function __construct($nome, $idPessoa){
        $this->nome = $nome;
        $this->idPessoa = $idPessoa;
    }

	function getNome(){
    	return $this->nome;
    }
	
	function setNome($nome){
		$this->nome = $nome;
	}

	

}



?>