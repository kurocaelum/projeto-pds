<?php 
// controlador da parte do gerenciamento de Servico. Essa classe que cadastra Servico, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre Servico e ServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");


class ControleCadastroServico{
	public $servicoDAO; // objeto dao para salvar as tipoServicos e obter dados.
	public $servico;

	public function __construct(){
		$this->servicoDAO = new servicoDAO();
		$this->servico = new Servico();
	}

	public function getServico(){
		return $this->servico;
	}

    public function addServico($servico){
    	//envia o objeto servico para a funcao salvar servico no servicoDAO
    	//criar esse método para inserir o servico no banco de dados
    	if($this->servicoDAO->insert($servico) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarServico($servico){
    	//envia o objeto servico para a funcao alterar servico no servicoDAO
    	return $this->servicoDAO->update($servico); //criar esse método para atualizar o servico no banco de dados
    }

    public function excluirServico($servico){
    	//envia o objeto servico para a funcao excluir servico no servicoDAO
    	return $this->servicoDAO->delete($servico); //criar esse método para excluir o servico no banco de dados
    }


    public function getListaServicos(){
    	return $this->servicoDAO->getServicos();
    }


    
	
}


?>