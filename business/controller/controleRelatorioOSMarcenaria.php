<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOSMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOMarcenaria.php");

class ControleRelatorioOSMarcenaria extends ControleRelatorioOS {

    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioOS = new ServiceRelatorioOSMarcenaria();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOMarcenaria);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOMarcenaria);

    }

}

?>