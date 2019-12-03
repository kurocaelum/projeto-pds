<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOMarcenaria.php");

class ControleCadastroOrdemServicoMarcenaria extends ControleCadastroOrdemServico {
    
    public function __construct(){
        $this->serviceOrdemServico = new ServiceOrdemServico();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOMarcenaria);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOMarcenaria);
        parent::__construct();
    }
}

if(isset($_POST['idOrdemServico']) || isset($_POST['listaOrdemServicos']) || isset($_POST['excluirOrdemServico']) || isset($_POST['addOrdemServico']) ){
    $controleCadastroOrdemServico = new ControleCadastroOrdemServicoMarcenaria();
}

?>