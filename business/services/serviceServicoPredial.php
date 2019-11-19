<?php 


include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServico.php");

class ServiceServicoPredial extends ServiceServico{

	public function __construct(){
		$this->servicoDAO = new ServicoDAOPredial();
	}
	



}


?>