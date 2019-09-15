<?php

class OrdemServico
{
	public $idOrdemServico;
	public $descricao;
	public $listaFuncionarios;
	public $listaServicos;
	
	public function __construct(){
		$listaFuncionarios = [];
		$listaServicos = [];
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

	public function addServico($idServico){
		 $this->listaServicos[count($this->listaServicos) + 1] = $idServico;
	}
	public function getListaServicos(){
		return $this->listaServicos;
	}

	public function addFuncionario($idFuncionario){
		 $this->listaFuncionarios[count($this->listaFuncionarios) + 1] = $idFuncionario;
	}
	public function getListaFuncionarios(){
		return $this->listaFuncionarios;
	}





}

?>