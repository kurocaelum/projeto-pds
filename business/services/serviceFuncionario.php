<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");


class ServiceFuncionario{
    public $funcionarioDAO; // objeto dao para salvar as funcionarios e obter dados.
    public $funcionario;

    public function __construct(){
        $this->funcionarioDAO = new FuncionarioDAO();
        $this->funcionario = new Funcionario();
    }

    public function getFuncionario(){
        return $this->funcionario;
    }

    // return 1: sucesso
    // return 0: erro na inserção
    public function addFuncionario(){
        if($this->funcionarioDAO->insert($this->getFuncionario()) == 1){
            return 1;
        }
        return 0;
    }

    // return 1: sucesso
    // return 0: erro na atualização
    // return 2: erro no supervisor
    public function alterarFuncionario(){
        if($this->funcionarioDAO->update($this->getFuncionario()) == 1){
            return 1;
        }
        return 0;
    }

    public function excluirFuncionario(){
        if($this->funcionarioDAO->delete($this->getFuncionario()) == 1){
            return 1;
        }
        return 0;
    }


    public function getListaFuncionarios(){
        $retorno = $this->funcionarioDAO->getFuncionarios();
        if($retorno != 0){
            return $retorno;
        }
        return 0;
    }


    public function setNomeFuncionario($nome){
        $this->getFuncionario()->setNome($nome);
    }

    public function setIdFuncionario($idFuncionario){
        $this->getFuncionario()->setIdFuncionario($idFuncionario);
    }

    public function setIdSupervisorChefeFuncionario($idSupervisorChefe){
       $this->getFuncionario()->setIdSupervisorChefe($setIdSupervisorChefe);
    }

    public function setEmailFuncionario($email){
        $this->getFuncionario()->setEmail($email);
    }
    
    public function setTelefoneFuncionario($telefone){
        $this->getFuncionario()->setTelefone($telefone);
    }

    
    
}


    
?>