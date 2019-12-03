<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOMarcenaria.php");

class ServiceTipoServicoMarcenaria extends ServiceTipoServico {

    public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAOMarcenaria();
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