<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");

 class ServicoManutencao extends Servico {
 	public $isTempoExtraFixo;
 	public $grauDificuldade;

 	public function __construct(){
 
 	}

 	public function getIsTempoExtraFixo(){
 		return $this->isTempoExtraFixo;
 	}
 	public function setIsTempoExtraFixo($isTempoExtraFixo){
 		$this->isTempoExtraFixo = $isTempoExtraFixo;
 	}

 	public function getGrauDificuldade(){
 		return $this->grauDificuldade;
 	}
 	public function setGrauDificuldade($grauDificuldade){
 		$this->grauDificuldade = $grauDificuldade;
 	}

 } 

 ?>









