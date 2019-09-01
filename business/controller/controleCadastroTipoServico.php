<?php 
// controlador da parte do gerenciamento de TipoServico. Essa classe que cadastra tipoServico, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre tipoServico e tipoServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");


class ControleCadastroTipoServico{
	public $tipoServicoDAO; // objeto dao para salvar as tipoServicos e obter dados.
	// public $tipoServicosArray; //lista de todas as tipoServicos
	public $tipoServico;

	public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAO();
		$this->tipoServico = new TipoServico();
		// $this->tipoServicosArray = [];
	}

	public function getTipoServico(){
		return $this->tipoServico;
	}

    public function addTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	//criar esse método para inserir a tipoServico no banco de dados
    	if($this->tipoServicoDAO->insert($tipoServico) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	return $this->tipoServicoDAO->update($tipoServico); //criar esse método para inserir a tipoServico no banco de dados
    }

    public function excluirTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	return $this->tipoServicoDAO->delete($tipoServico); //criar esse método para inserir a tipoServico no banco de dados
    }


    public function getListaTipoServicos(){
    	return $this->tipoServicoDAO->getTiposServicos();
    }


    
	
}

	
 ?>