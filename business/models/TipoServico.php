<?php

class TipoServico{
	public $nome;
	public $unidadeMedida;
	public $tempo;
	public $id_tipo_servico;
	
	public function __construct(){
		$this->nome = "";
		$this->unidadeMedida = "";
		$this->tempo = "";
	}
	
	function setIdTipoServico($id_tipo_servico){
		$this->id_tipo_servico = $id_tipo_servico;
	}
	function getIdTipoServico(){
		return $this->id_tipo_servico;
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