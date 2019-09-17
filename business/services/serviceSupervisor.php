<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Supervisor.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/supervisorDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");


class ServiceSupervisor{
    public $supervisorDAO; // objeto dao para salvar os supervisores e obter dados.

    public function __construct(){
        $this->supervisorDAO = new SupervisorDAO();
    }

    public function addSupervisor($supervisor){
        try {
            $this->verificarSupervisor($supervisor);
            $this->verificarIdFuncionario($supervisor);
            return $this->supervisorDAO->insert($supervisor);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function alterarSupervisor($supervisor){
        try {
            $this->verificarIdSupervisor($supervisor);
            $this->verificarSupervisor($supervisor);
            $this->verificarIdFuncionario($supervisor);
            return $this->supervisorDAO->update($supervisor);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function excluirSupervisor($supervisor){
        try {
            $this->verificarIdSupervisor($supervisor);
            return $this->supervisorDAO->delete($supervisor);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }

    public function getListaSupervisores(){
        try {
            $retorno = $this->supervisorDAO->getSupervisores();
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
        return $retorno;
    }

    //verifica se o supervisor está cadastrado, caso contrário retorna exceção
    public function verificarIdSupervisor($supervisor){
       
        if(count($this->supervisorDAO->getSupervisorById($supervisor->getIdSupervisor())) == 0){
            throw new ServiceException("Supervisor não encontrado.");
        }
    }

    //verifica se o funcionário está cadastrado, caso contrário retorna exceção
    public function verificarIdFuncionario($supervisor){
       
        if(count((new FuncionarioDAO())->getFuncionarioById($supervisor->getIdFuncionario())) == 0){
            throw new ServiceException("Funcionário não encontrado.");
        }
    }



    public function verificarSupervisor($supervisor){
        $ret = "";

        if($supervisor->getSetor() == ""){
            $ret = $ret."Setor não informado.\n";
        }
        
        if($supervisor->getIdFuncionario() == ""){
             $ret = $ret."Nenhum funcionário selecionado.\n";
        }

        if($ret != ""){
            throw new ServiceException($ret);
        }
    }



    
    
}


    
?>