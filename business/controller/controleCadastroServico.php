<?php 
// controlador da parte do gerenciamento de Servico. Essa classe recebe os dados do html, faz a //validação dos dados, encapsula-os em um objeto Servico e envia para serviceServico

include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");


class ControleCadastroServico{

	private $serviceServico;
	private $servico;

	public function __construct(){
		
		$this->serviceServico = new ServiceServico();
		$this->servico = new Servico();
		$this->verificarRequisicao();
	}

	public function verificarRequisicao(){

        if(isset($_POST['idServico'])){

            if($_POST['idServico'] != ""){
                echo $this->alterarServico();
            }else{
                if(isset($_POST['addServico'])){
                    echo $this->addServico();  
                }
            }
        }
        if(isset($_POST['listaServicos'])){
            echo json_encode($this->getListaServicos(), JSON_PRETTY_PRINT);
        }
        if(isset($_POST['excluirServico'])){
            echo $this->excluirServico();
        }
        
    }

    private function setServico(){

         $nome = $_POST['nome'];
         $local = $_POST['local'];
         $dataCadastro = $_POST['data'];
         $status = $_POST['status'];
         $tipoServico = $_POST['tipoServico'];
         $quantidade = $_POST['quantidade'];

         $this->servico->setNome($nome);
         $this->servico->setLocal($local);
         $this->servico->setDataCadastro($dataCadastro);
         $this->servico->setStatus($status);
         $this->servico->setTipoServico($tipoServico);
         $this->servico->setQuantidade($quantidade);

    }


    public function addServico(){

        $this->setServico();
        try {
        	return $this->serviceServico->addServico($this->servico);
        	
        } catch (DataException | ServiceException $e) {
        	return $e->getMessage();
        }  	
    }

    public function alterarServico(){
    
        $this->setServico();
    	$this->servico->setIdServico($_POST['idServico']);
    	try {
        	return $this->serviceServico->alterarServico($this->servico);
        	
        } catch (DataException | ServiceException $e) {
        	return $e->getMessage();
        }
    }

    public function excluirServico(){
    	
    	$this->servico->setIdServico($_POST['excluirServico']);
    	try {
        	return $this->serviceServico->excluirServico($this->servico);
        	
        } catch (DataException | ServiceException $e) {
        	return $e->getMessage();
        }
    }


    public function getListaServicos(){
    	try {
        	return $this->serviceServico->getListaServicos();
        	
        } catch (DataException | ServiceException $e) {
        	return $e->getMessage();
        }
    }
	
}


if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
    $controleCadastroServico = new ControleCadastroServico();
}


?>