<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServico.php");

class ServiceTipoServicoPredial extends ServiceTipoServico{
	

	public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAOPredial();
		
	}

	public function validarDadosTipoServicoSecundario($tipoServico){
		$ret= "";

        // if(!is_numeric($tipoServico->getPorcentagemAjudante())){
        //     $ret .= "Porcentagem ajudante deve ser um valor numérico\n";  
        // }

        // if(!is_numeric($tipoServico->getTempoRemocao())){
        //     $ret .= "Tempo para remoção deve ser um valor numérico\n";  
        // }
        
        // if($ret != ""){
        //     throw new ServiceException($ret);
        // }
	}



}


	
 ?>