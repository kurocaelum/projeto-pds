<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOSPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOPredial.php");

class ControleRelatorioOSPredial extends ControleRelatorioOS{


    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioOS = new ServiceRelatorioOSPredial();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOPredial);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOPredial);

    }



}



    
?>