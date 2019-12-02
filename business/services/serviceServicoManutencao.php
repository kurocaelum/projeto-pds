<?php 


include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServico.php");

class ServiceServicoManutencao extends ServiceServico{

	public function __construct(){
		$this->servicoDAO = new ServicoDAOManutencao();
	}
	



}


?>