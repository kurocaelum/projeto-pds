<?php

class OrdemServico
{
	public $idOrdemServico;
	public $descricao;
	public $listaFuncionarios;
	public $listaServicos;
	public $status; // porcentagem dos serviços concluídos, leva em conta o tempo de cada
	public $tempoEstimadoTotal; // total estimado dos servicos
	public $tempoRealTotal;
	public $pocentagemTempoUtilizado; // porcentagem do tempo disponível utilizado
	
	public function __construct(){
		$listaFuncionarios = [];
	}

	public function setIdOrdemServico($idOrdemServico){
		$this->idOrdemServico = $idOrdemServico;
	}
	public function getIdOrdemServico(){
		return $this->idOrdemServico;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setTempoEstimadoTotal($tempoEstimadoTotal){
		$this->tempoEstimadoTotal = $tempoEstimadoTotal;
	}
	public function getTempoEstimadoTotal(){
		return $this->tempoEstimadoTotal;
	}
	public function setTempoExecucaoTotal($tempoRealTotal){
		$this->tempoRealTotal = $tempoRealTotal;
	}
	public function getTempoExecucaoTotal(){
		return $this->tempoRealTotal;
	}
	public function setPocentagemTempoUtilizado($pocentagemTempoUtilizado){
		$this->pocentagemTempoUtilizado = $pocentagemTempoUtilizado;
	}
	public function getPocentagemTempoUtilizado(){
		return $this->pocentagemTempoUtilizado;
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