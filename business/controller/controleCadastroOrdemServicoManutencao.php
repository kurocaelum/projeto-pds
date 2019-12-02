<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOManutencao.php");

class ControleCadastroOrdemServicoManutencao extends ControleCadastroOrdemServico{
 
    public function __construct(){
        $this->serviceOrdemServico = new ServiceOrdemServico();
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfTipoServicoDAO(new TipoServicoDAOManutencao);
        $this->serviceOrdemServico->getOrdemServicoDAO()->instanceOfServicoDAO(new ServicoDAOManutencao);
        parent::__construct();


    }


}


if(isset($_POST['idOrdemServico']) || isset($_POST['listaOrdemServicos']) || isset($_POST['excluirOrdemServico']) || isset($_POST['addOrdemServico']) ){
    $controleCadastroOrdemServico = new ControleCadastroOrdemServicoManutencao();
}
    
?>