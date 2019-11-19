<?php 
//Classe de serviços da parte do gerenciamento de TipoServico. Essa classe recebe o tipo de serviço do //controlador, avalia as regras de negócio e depois envia para a camada de dados. Ela que faz ligacao entre //controllerTipoServico e tipoServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOPredial.php");


abstract class ServiceTipoServico{
	public $tipoServicoDAO; // objeto dao para salvar as tipoServicos e obter dados.


	public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAO();
		
	}


    public function addTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    
        try {

            $this->validarDadosTipoServico($tipoServico);
            return $this->tipoServicoDAO->insert($tipoServico); 
            
        } catch (DataException $e) {
            throw $e;
        }
    }

    public function alterarTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao alterar tipoServico no tipoServicoDAO
        
         try {
                       
            $this->validarDadosTipoServico($tipoServico);
            return $this->tipoServicoDAO->update($tipoServico);
        } catch (DataException $e) {
            throw $e;            
        }       
    }

    public function excluirTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao excluir tipoServico no tipoServicoDAO

        try {
            return $this->tipoServicoDAO->delete($tipoServico);
        } catch (DataException $e) {
            throw $e;
        }
    }


    public function getListaTipoServicos(){

        try {
            return $this->tipoServicoDAO->getTiposServicos();
        } catch (DataException $e) {
            throw $e;
        }
    	
    }

    private function validarDadosTipoServico($tipoServico){
        $ret= "";
        if($tipoServico->getNome() == "" ){
            $ret .= "Nome não informado\n";  
        }
        if($tipoServico->getUnidadeMedida() == "" ){
            $ret .= "Unidade de medida não informada\n";  
        }
        if(is_numeric($tipoServico->getUnidadeMedida())){
            $ret .= "Unidade de medida inválida\n";  
        }
        if($tipoServico->getTempo() == "" ){
            $ret .= "Tempo não informado\n";  
        }
        if(!is_numeric($tipoServico->getTempo())){
            $ret .= "Tempo deve ser um valor numérico\n";  
        }
        
        if($ret != ""){
            throw new ServiceException($ret);
            
        }
        $this->validarDadosTipoServicoSecundario($tipoServico);
    }


    abstract function validarDadosTipoServicoSecundario($tipoServico);


    
	
}

	
 ?>