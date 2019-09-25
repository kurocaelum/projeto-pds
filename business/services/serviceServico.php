<?php 
//Classe de serviços da parte do gerenciamento de Servico. Essa classe recebe o serviço do 
//controlador, avalia as regras de negócio e depois envia para a camada de dados. Ela que faz ligacao entre //controllerServico e ServicoDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
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
            $this->validarIdTipoServico($servico);
            return $this->servicoDAO->insert($servico); 
            
        } catch (DataException $e) {
            throw $e;
        }
       
    }

    public function alterarServico($servico){
    	//envia o objeto servico para a funcao alterar servico no servicoDAO

        try {
                       
            $this->validarDadosServico($servico);
            $this->validarIdServico($servico);
            $this->validarIdTipoServico($servico);
    	    return $this->servicoDAO->update($servico);
        } catch (DataException $e) {
            throw $e;            
        }        
    }

    public function excluirServico($servico){
    	//envia o objeto servico para a funcao excluir servico no servicoDAO

        try {
            $this->validarIdServico($servico);
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

    private function validarIdServico($servico){
        if(count($this->servicoDAO->getServicoById($servico->getIdServico())) == 0){
            throw new ServiceException("Serviço não encontrado");
            
        }
    }

    private function validarIdTipoServico($servico){
        if(count((new TipoServicoDAO())->getTipoServicoById($servico->getTipoServico())) == 0){
            throw new ServiceException("Tipo de Serviço não encontrado");
            
        }
    }

    public function getServicoById($id){
        try {
            $retorno = $this->servicoDAO->getServicoById($id);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
        return $retorno;
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
        if(!is_numeric($servico->getTempoExecucao())){
            if($servico->getTempoExecucao() == ""){
                $servico->setTempoExecucao(-1);
            }else{
                $ret .= "Tempo de Execução deve ser um valor numérico\n";  
            }
            
        }
        
        
        
        if($ret != ""){
            throw new ServiceException($ret);
            
        }

    }




}


?>