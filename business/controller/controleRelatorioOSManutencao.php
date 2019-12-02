<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOSManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOManutencao.php");

class ControleRelatorioOSManutencao extends ControleRelatorioOS{


    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioOS = new ServiceRelatorioOSManutencao();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOManutencao);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOManutencao);

    }



}



    
?>