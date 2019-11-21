<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOPredial.php");

class ControleCadastroOrdemServicoPredial extends ControleCadastroOrdemServico{
 
    public function __construct(){
        $this->serviceOrdemServico = new ServiceOrdemServico();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOPredial);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOPredial);
        parent::__construct();


    }


}


if(isset($_POST['idOrdemServico']) || isset($_POST['listaOrdemServicos']) || isset($_POST['excluirOrdemServico']) || isset($_POST['addOrdemServico']) ){
    $controleCadastroOrdemServico = new ControleCadastroOrdemServicoPredial();
}
    
?>