<?php

class OrdemServico
{
	public $idOrdemServico;
	public $descricao;
	public $listaFuncionarios;
	public $listaServicos;
	public $tempoTotal;
	
	public function __construct(){
		$listaFuncionarios = [];
	}

	public function setIdOrdemServico($idOrdemServico){
		$this->idOrdemServico = $idOrdemServico;
	}
	public function getIdOrdemServico(){
		return $this->idOrdemServico;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao(){
		return $this->descricao;
	}

	public function addServico($servico){
		 $this->listaServicos[count($this->listaServicos) + 1] = $servico;
	}

	public function getListaServicos(){
		return $this->listaServicos;
	}

	public function setListaServicos($listaServicos){
		$this->listaServicos = $listaServicos;
	}

	public function addFuncionario($idFuncionario){
		 $this->listaFuncionarios[count($this->listaFuncionarios) + 1] = $idFuncionario;
	}
	public function getListaFuncionarios(){
		return $this->listaFuncionarios;
	}





}

?>