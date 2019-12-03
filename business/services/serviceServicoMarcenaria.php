<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServico.php");

class ServiceServicoMarcenaria extends ServiceServico {


    public function __construct(){
		$this->servicoDAO = new ServicoDAOMarcenaria();
	}
	
}


?>