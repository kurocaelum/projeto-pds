<?php 
//Classe de serviços da parte do gerenciamento de Servico. Essa classe recebe o serviço do 
//controlador, avalia as regras de negócio e depois envia para a camada de dados. Ela que faz ligacao entre //controllerServico e ServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");


class ServiceServico{
	private $servicoDAO; // objeto dao para salvar as tipoServicos e obter dados.

	public function __construct(){
		$this->servicoDAO = new servicoDAO();
	}
	

    public function addServico($servico){
    	//envia o objeto servico para a funcao salvar servico no servicoDAO

        try {

            $this->validarDadosServico($servico);
            return $this->servicoDAO->insert($servico); 
            
        } catch (DataException $e) {
            throw $e;
        }
       
    }

    public function alterarServico($servico){
    	//envia o objeto servico para a funcao alterar servico no servicoDAO

        try {
                       
            $this->validarDadosServico($servico);
    	    return $this->servicoDAO->update($servico);
        } catch (DataException $e) {
            throw $e;            
        }        
    }

    public function excluirServico($servico){
    	//envia o objeto servico para a funcao excluir servico no servicoDAO

        try {
            return $this->servicoDAO->delete($servico);
        } catch (DataException $e) {
            throw $e;
        }
    	
    }


    public function getListaServicos(){
        try {
            return $this->servicoDAO->getServicos();
        } catch (DataException $e) {
            throw $e;
        }
    	
    }

    private function validarDadosServico($servico){

        $ret="";

        if($servico->getNome() == "" ){
           $ret .= "Nome não informado\n";  
        }
        if($servico->getLocal() == "" ){
            $ret .= "Local não informado\n";  
        }
        if($servico->getDataCadastro() == "" ){
            $ret .= "Data não informada\n";  
        }
        if($servico->getStatus() == "" ){
            $ret .= "Status não informado\n";  
        }
        if($servico->getTipoServico() == "" ){
            $ret .= "Tipo de Serviço não informado\n";  
        }
        if($servico->getQuantidade() == "" ){
            $ret .= "Quantidade não informada\n";  
        }
        if(!is_numeric($servico->getQuantidade())){
            $ret .= "Quantidade deve ser um valor numérico\n";  
        }
        
        if($ret != ""){
            throw new ServiceException($ret);
            
        }

    }
	
}


?>