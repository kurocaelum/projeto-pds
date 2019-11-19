<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");

 class ServicoPredial extends Servico {
 	public $quantidadeAjudante;
 	public $remocao;

 	public function __construct(){
 
 	}

 	public function getQuantidadeAjudante(){
 		return $this->quantidadeAjudante;
 	}
 	public function setQuantidadeAjudante($quantidadeAjudante){
 		$this->quantidadeAjudante = $quantidadeAjudante;
 	}

 	public function getRemocao(){
 		return $this->remocao;
 	}
 	public function setRemocao($remocao){
 		$this->remocao = $remocao;
 	}

 } 

 ?>

