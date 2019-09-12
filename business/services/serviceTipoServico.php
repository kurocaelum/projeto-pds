<?php 
//Classe de serviços da parte do gerenciamento de TipoServico. Essa classe recebe o tipo de serviço do //controlador, avalia as regras de negócio e depois envia para a camada de dados. Ela que faz ligacao entre //controllerTipoServico e tipoServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");


class ServiceTipoServico{
	public $tipoServicoDAO; // objeto dao para salvar as tipoServicos e obter dados.


	public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAO();
		
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