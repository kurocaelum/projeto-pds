<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/ordemServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");

class ControleCadastroOrdemServico{
    public $serviceOrdemServico;
    public $ordemServico;

    public function __construct(){
        $this->ordemServico = new OrdemServico();
        $this->serviceOrdemServico = new ServiceOrdemServico();
        $this->verificarRequisicao();
    }

    public function verificarRequisicao(){
        if(isset($_POST['idOrdemServico'])){
            if($_POST['idOrdemServico'] != ""){
                $this->ordemServico->setIdOrdemServico($_POST['idOrdemServico']);
                echo $this->alterarOrdemServico();
            }else{
                if(isset($_POST['addOrdemServico'])){
                    echo $this->addOrdemServico();  
                }
            }
        }
     
        if(isset($_POST['listaOrdemServicos'])){
            echo json_encode($this->listarOrdemServicos(), JSON_PRETTY_PRINT);
        }
     
        if(isset($_POST['excluirOrdemServico'])){
            $this->ordemServico->setIdOrdemServico($_POST['excluirOrdemServico']);
            echo $this->excluirOrdemServico();
        }   
    }

    public function setAtrOrdemServico($descricao, $funcionarios, $servicos){
        $this->ordemServico->setDescricao($descricao);

        foreach ($funcionarios as $funcionario) {
            $this->ordemServico->addFuncionario($funcionario);            
        }
        foreach ($servicos as $servico) {
            $this->ordemServico->addServico($servico);            
        }
    }

    public function setAtrPostsOrdemServico(){
        $descricao = $_POST['descricao'];
        $funcionarios = explode(",", $_POST['ids_funcionarios']);
        $servicos = explode(",", $_POST['ids_servicos']);
        $this->setAtrOrdemServico($descricao, $funcionarios, $servicos);
    }
    

    public function addOrdemServico(){    
        $this->setAtrPostsOrdemServico();
        try {    
            $this->serviceOrdemServico->addOrdemServico($this->getOrdemServico());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function alterarOrdemServico(){
        $this->setAtrPostsOrdemServico();
        try {    
            $this->serviceOrdemServico->alterarOrdemServico($this->getOrdemServico());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function excluirOrdemServico(){
        try {    
            $this->serviceOrdemServico->excluirOrdemServico($this->getOrdemServico());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function listarOrdemServicos(){
        try {    
            $retorno = $this->serviceOrdemServico->getListaOrdemServico();
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return $retorno;
    }

    public function getOrdemServico(){
        return $this->ordemServico;
    }



}


if(isset($_POST['idOrdemServico']) || isset($_POST['listaOrdemServicos']) || isset($_POST['excluirOrdemServico']) || isset($_POST['addOrdemServico']) ){
    $controleCadastroOrdemServico = new ControleCadastroOrdemServico();
}
    
?>