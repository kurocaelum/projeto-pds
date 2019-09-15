<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");


class ServiceFuncionario{
    public $funcionarioDAO; // objeto dao para salvar as funcionarios e obter dados.

    public function __construct(){
        $this->funcionarioDAO = new FuncionarioDAO();
    }

    public function addFuncionario($funcionario){
        try {
            $this->verificarFuncionario($funcionario);
            $this->funcionarioDAO->insert($funcionario);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function alterarFuncionario($funcionario){
        try {
            $this->verificarDataId($funcionario);
            $this->verificarFuncionario($funcionario);
            $this->funcionarioDAO->update($funcionario);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function excluirFuncionario($funcionario){
        try {
            $this->verificarDataId($funcionario);
            $this->funcionarioDAO->delete($funcionario);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function getListaFuncionarios(){
        try {
            $retorno = $this->funcionarioDAO->getFuncionarios();
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
        return $retorno;
    }

    //verifica se o funcionário está cadastrado, caso contrário retorna exceção
    public function verificarDataId($funcionario){
        // echo $this->funcionarioDAO->getFuncionarioById($funcionario->getIdFuncionario());
        // echo "string";
        if(count($this->funcionarioDAO->getFuncionarioById($funcionario->getIdFuncionario())) == 0){
            throw new ServiceException("Funcionário não encontrado.");
        }
    }

    public function verificarFuncionario($funcionario){
        $ret = "";

        if($funcionario->getNome() == ""){
            $ret = $ret."Nome não informado.\n";
        }

        if($funcionario->getEmail() == ""){
            $ret = $ret."Email não informado.\n";
        }else{
            if(count($this->funcionarioDAO->getFuncionarioByEmail($funcionario->getEmail())) != 0){
                throw new ServiceException("Email já cadastrado.");
            }
        }
        
        if($funcionario->getTelefone() == ""){
            $ret = $ret."Telefone não informado.\n";
        }

        if($funcionario->idSupervisorChefe() != ""){
            if($funcionario->idSupervisorChefe() == $funcionario->idFuncionario()){
                $ret = $ret."ID chefe igual ao ID do funcionário.\n";
            }
        }

        if($ret != ""){
            throw new ServiceException($ret);
        }
    }



    
    
}


    
?>