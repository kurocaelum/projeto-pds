<?php 
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/RelatorioFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOSPredial.php");

// include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/ordemServicoDAO.php");
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");


class ControleRelatorioFuncionarioPredial extends ControleRelatorioFuncionario{
 
    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioOS = new ServiceRelatorioOSPredial();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOPredial);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOPredial);
    }


}



    
?>