<?php 
include_once("TipoServico.php");

class TipoServicoPredial extends TipoServico{
	public $porcentagemAjudante;
	public $tempoRemocao;

	function setPorcentagemAjudante($porcentagemAjudante){
		$this->porcentagemAjudante = $porcentagemAjudante;
	}

	function getPorcentagemAjudante(){
		return $this->porcentagemAjudante;
	}

	function setTempoRemocao($tempoRemocao){
		$this->tempoRemocao = $tempoRemocao;
	}

	function getTempoRemocao(){
		return $this->tempoRemocao;
	}
}


 ?>