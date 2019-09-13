<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceFuncionario.php");

class ControleCadastroFuncionario{
    public $serviceFuncionario;
    public $funcionario;

    public function __construct(){
        $this->funcionario = new Funcionario();
        $this->serviceFuncionario = new ServiceFuncionario();
        $this->verificarRequisicao();
    }

    public function verificarRequisicao(){
        if(isset($_POST['idFuncionario'])){
            if($_POST['idFuncionario'] != ""){
                $this->funcionario->setIdFuncionario($_POST['idFuncionario']);
                echo $this->alterarFuncionario();
            }else{
                if(isset($_POST['addFuncionario'])){
                    echo $this->addFuncionario();  
                }
            }
        }
     
        if(isset($_POST['listaFuncionarios'])){
            echo json_encode($this->listarFuncionarios(), JSON_PRETTY_PRINT);
        }
     
        if(isset($_POST['excluirFuncionario'])){
            $this->funcionario->setIdFuncionario($_POST['excluirFuncionario']);
            echo $this->excluirFuncionario();
        }   
    }

    public function setAtrFuncionario($nome, $telefone, $email, $supervisor_chefe){
        $this->funcionario->setNome($nome);
        $this->funcionario->setTelefone($telefone);
        $this->funcionario->setEmail($email);
        $this->funcionario->setIdSupervisorChefe($supervisor_chefe);
    }

    public function setAtrPostsFuncionario(){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $supervisor_chefe = $_POST['supervisor_chefe'];
        $this->setAtrFuncionario($nome, $telefone, $email, $supervisor_chefe);
    }
    

    public function addFuncionario(){    
        $this->setAtrPostsFuncionario();
        try {    
            $this->serviceFuncionario->addFuncionario($this->getFuncionario());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function alterarFuncionario(){
        try {    
            $this->serviceFuncionario->alterarFuncionario($this->getFuncionario());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function excluirFuncionario(){
        try {    
            $this->serviceFuncionario->excluirFuncionario($this->getFuncionario());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return 1;
    }

    public function listarFuncionarios(){
        try {    
            $retorno = $this->serviceFuncionario->getListaFuncionarios();
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
        return $retorno;
    }

    public function getFuncionario(){
        return $this->funcionario;
    }



}


if(isset($_POST['idFuncionario']) || isset($_POST['listaFuncionarios']) || isset($_POST['excluirFuncionario']) || isset($_POST['addFuncionario']) ){
    $controleCadastrofuncionario = new ControleCadastroFuncionario();
}
    
?>