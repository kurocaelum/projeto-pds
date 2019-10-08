<?php

class Imprevisto
{
	public $idImprevisto;
	public $servico;
	public $descricao;
	public $quantidade;

	public function __construct(){
	}
	
	public function setIdImprevisto($id){
		$this->idImprevisto = $id;
	}
	
	public function getIdImprevisto(){
		return $this->idImprevisto;
	}
	
	public function setServico($servico){
		$this->servico = $servico;
	}
	
	public function getServico(){
		return $this->servico;
	}
	
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}
	
	public function getQuantidade(){
		return $this->quantidade;
	}
}

?>