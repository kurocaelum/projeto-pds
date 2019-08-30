<?php

 class Servico
 {
 	private $tipoServico;
 	private $quantidade;
 	private $localizacao;
 	private $dataCadastro;
 	private $status;
 	
 	public function __construct($tipoServico, $quantidade, $localizacao, $dataCadastro, $status)
 	{
 		$this->tipoServico = $tipoServico;
 		$this->quantidade = $quantidade;
 		$this->localizacao = $localizacao;
 		$this->dataCadastro = $dataCadastro;
 		$this->status = $status;
 	}

 	public function getTipoServico(){
 		return $this->$tipoServico;
 	}
 	public function getQuantidade(){
 		return $this->$quantidade;
 	}
 	public function getLocalizacao(){
 		return $this->$localizacao;
 	}
 	public function getDataCadastro(){
 		return $this->$dataCadastro;
 	}
 	public function getStatus(){
 		return $this->$status;
 	}

 	public function setTipoServico($tipoServico){
 		$this->$tipoServico = $tipoServico;
 	}
 	public function setQuantidade($quantidade){
 		$this->$quantidade = $quantidade;
 	}
 	public function setLocalizacao($localizacao){
 		$this->$localizacao = $localizacao;
 	}
 	public function setDataCadastro($dataCadastro){
 		$this->$dataCadastro = $dataCadastro;
 	}
 	public function setStatus($status){
 		$this->$status = $status;
 	}


 } 

 ?>

