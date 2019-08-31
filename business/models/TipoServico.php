<?php

class TipoServico{
	private $nome;
	private $unidadeMedida;
	private $tempo;

	
	public function __construct(){
		$this->nome = "";
		$this->unidadeMedida = "";
		$this->tempo = "";
	}

	function setNome($nome){
		$this->nome = $nome;
	}

	function getNome(){
		return $this->nome;
	}

	function setUnidadeMedida($unidadeMedida){
		$this->unidadeMedida = $unidadeMedida;
	}

	function getUnidadeMedida(){
		return $this->unidadeMedida;
	}

	function setTempo($tempo){
		$this->tempo = $tempo;
	}

	function getTempo(){
		return $this->tempo;
	}

}

?>