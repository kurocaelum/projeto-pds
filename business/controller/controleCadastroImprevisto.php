<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Imprevisto.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/imprevistoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceImprevisto.php");

class ControleCadastroImprevisto{
    public $serviceImprevisto;
    public $imprevisto;


    public function __construct(){
        $this->imprevisto = new Imprevisto();
        $this->serviceImprevisto = new ServiceImprevisto();
        $this->verificarRequisicao();

    }

    public function verificarRequisicao(){
        if(isset($_POST['idImprevisto'])){
            if($_POST['idImprevisto'] != ""){
                $this->funcionario->setIdImprevisto($_POST['idImprevisto']);
                echo $this->alterarImprevisto();
            }else{
                if(isset($_POST['addImprevisto'])){
                    echo $this->addImprevisto();  
                }
            }
        }
    
        if(isset($_POST['listaImprevistos'])){
            echo json_encode($this->listarImprevistos(), JSON_PRETTY_PRINT);
        }
    
        if(isset($_POST['excluirImprevisto'])){
            $this->funcionario->setIdImprevisto($_POST['excluirImprevisto']);
            echo $this->excluirImprevisto();
        }   
    }

    public function setAtrImprevisto($servico, $descricao, $quantidade){
        $this->imprevisto->setServico($servico);
        $this->imprevisto->setDescricao($descricao);
        $this->imprevisto->setQuantidade($quantidade);
    }

    public function setAtrPostsImprevisto() {
        $servico = $_POST['servico'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $this->setAtrImprevisto($servico, $descricao, $quantidade);
    }

    public function addImprevisto(){    
        $this->setAtrPostsImprevisto();
        try {    
            $this->serviceImprevisto->addImprevisto($this->getImprevisto());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function alterarImprevisto(){
        $this->setAtrPostsImprevisto();
        try {    
            $this->serviceImprevisto->alterarImprevisto($this->getImprevisto());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function excluirImprevisto(){
        try {    
            $this->serviceImprevisto->excluirImprevisto($this->getImprevisto());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function listarImprevistos(){
        try {    
            $retorno = $this->serviceImprevisto->getListaImprevistos();
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return $retorno;
    }

    public function getImprevisto(){
        return $this->imprevisto;
    }

}

if(isset($_POST['idImprevisto']) || isset($_POST['listaImprevistos']) || isset($_POST['excluirImprevisto']) || isset($_POST['addImprevisto']) ){
    $controleCadastrofuncionario = new ControleCadastroImprevisto();
}

?>