<?php

 class Servico
 {
 	public $idServico;
 	public $nome;
 	public $tipoServico;
 	public $quantidade;
 	public $local;
 	public $dataCadastro;
 	public $status;
 	public $tempoExecucao;
 	public $porcentagemTempo;
 	public $estimativaTempoTotal;

 	public function __construct()
 	{
 
 	}
 	
 	/*
 	public function __construct($nome, $tipoServico, $quantidade, $local, $dataCadastro, $status)
 	{
 		$this->nome = $nome;
 		$this->tipoServico = $tipoServico;
 		$this->quantidade = $quantidade;
 		$this->local = $local;
 		$this->dataCadastro = $dataCadastro;
 		$this->status = $status;
 	}
 	*/

 	public function getNome(){
 		return $this->nome;
 	}

 	public function getIdServico(){
 		return $this->idServico;
 	}

 	public function getTipoServico(){
 		return $this->tipoServico;
 	}
 	public function getQuantidade(){
 		return $this->quantidade;
 	}
 	public function getLocal(){
 		return $this->local;
 	}
 	public function getDataCadastro(){
 		return $this->dataCadastro;
 	}
 	public function getStatus(){
 		return $this->status;
 	}
 	public function getTempoExecucao(){
 		return $this->tempoExecucao;
 	}


 	public function setIdServico($idServico){
 		$this->idServico = $idServico;
 	}
 	
 	public function setNome($nome){
 		$this->nome = $nome;
 	}

 	public function setTipoServico($tipoServico){
 		$this->tipoServico = $tipoServico;
 	}
 	public function setQuantidade($quantidade){
 		$this->quantidade = $quantidade;
 	}
 	public function setLocal($local){
 		$this->local = $local;
 	}
 	public function setDataCadastro($dataCadastro){
 		$this->dataCadastro = $dataCadastro;
 	}
 	public function setStatus($status){
 		$this->status = $status;
 	}
 	public function setTempoExecucao($tempo){
 		$this->tempoExecucao = $tempo;
 	}

 	public function getPorcentagemTempo(){
 		return $this->porcentagemTempo;
 	}
 	public function setPorcentagemTempo($porcentagemTempo){
 		$this->porcentagemTempo = $porcentagemTempo;
 	}

 	public function getEstimativaTempoTotal(){
 		return $this->estimativaTempoTotal;
 	}
 	public function setEstimativaTempoTotal($estimativaTempoTotal){
 		$this->estimativaTempoTotal = $estimativaTempoTotal;
 	}


 } 

 ?>

