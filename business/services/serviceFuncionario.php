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

    public function addFuncionario(){
        if($this->funcionarioDAO->insert($this->getFuncionario()) == 1){
            return 1;
        }
        return 0;
    }

    public function alterarFuncionario(){
        return $this->funcionarioDAO->update($this->getFuncionario()); //criar esse método para inserir a funcionario no banco de dados
    }

    public function excluirFuncionario(){
        return $this->funcionarioDAO->delete($this->getFuncionario()); //criar esse método para inserir a funcionario no banco de dados
    }


    public function getListaFuncionarios(){
        return $this->funcionarioDAO->getFuncionarios();
    }


    
    
}


    
?>