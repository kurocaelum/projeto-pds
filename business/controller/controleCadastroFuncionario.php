<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");


class ControleCadastroFuncionario{
	public $funcionarioDAO; // objeto dao para salvar as funcionarios e obter dados.
	// public $funcionariosArray; //lista de todas as funcionarios
	public $funcionario;

	public function __construct(){
		$this->funcionarioDAO = new FuncionarioDAO();
		$this->funcionario = new Funcionario();
		// $this->funcionariosArray = [];
	}

	public function getFuncionario(){
		return $this->funcionario;
	}

    public function addFuncionario($funcionario){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	//criar esse método para inserir a funcionario no banco de dados
    	if($this->funcionarioDAO->insert($funcionario) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarFuncionario($funcionario){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	return $this->funcionarioDAO->update($funcionario); //criar esse método para inserir a funcionario no banco de dados
    }

    public function excluirFuncionario($funcionario){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	return $this->funcionarioDAO->delete($funcionario); //criar esse método para inserir a funcionario no banco de dados
    }


    public function getListaFuncionarios(){
    	return $this->funcionarioDAO->getFuncionarios();
    }


    
	
}


	
?>