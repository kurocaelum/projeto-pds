<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServicoPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");


abstract class ControleCadastroServico{

	public $serviceServico;
	public $servico;

	public function __construct(){
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

    public function setServico(){

         $nome = $_POST['nome'];
         $local = $_POST['local'];
         $dataCadastro = $_POST['data'];
         $status = $_POST['status'];
         $tipoServico = $_POST['tipoServico'];
         $quantidade = $_POST['quantidade'];
         $tempo = $_POST['tempo'];

         $this->servico->setNome($nome);
         $this->servico->setLocal($local);
         $this->servico->setDataCadastro($dataCadastro);
         $this->servico->setStatus($status);
         $this->servico->setTipoServico($tipoServico);
         $this->servico->setQuantidade($quantidade);
         $this->servico->setTempoExecucao($tempo);

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




?>