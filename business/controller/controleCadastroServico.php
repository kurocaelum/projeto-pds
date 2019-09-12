<?php 
// controlador da parte do gerenciamento de Servico. Essa classe que cadastra Servico, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre Servico e ServicoDAO

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
                $this->alterarServico();
            }else{
                if(isset($_POST['addServico'])){
                    $this->addServico();  
                }
            }
        }
        if(isset($_POST['listaServicos'])){
            $this->getListaServicos();
        }
        if(isset($_POST['excluirServico'])){
            $this->excluirServico();
        }
        
    }


    public function addServico(){
    	
    	if(!$this->validarDadosServico()){
    		return false;
    	}

    	return $this->serviceServico->addServico($this->servico);
    	
    }

    public function alterarServico(){
    
    	if(!$this->validarDadosServico()){
    		return false;
    	}
    	$this->servico->setId($_POST['idServico']);

    	return $this->serviceServico->alterarServico($this->servico); 
    }

    public function excluirServico(){
    	
    	$this->validarDadosServico();
    	$this->servico->setId($_POST['idServico']);

    	return $this->serviceServico->excluirServico($this->servico); 
    }


    public function getListaServicos(){
    	return $this->serviceServico->getListaServicos();
    }

    public function validarDadosServico(){

    	 $nome = $_POST['nome'];
		 $local = $_POST['local'];
		 $dataCadastro = $_POST['data'];
		 $status = $_POST['status'];
		 $tipoServico = $_POST['tipoServico'];
		 $quantidade = $_POST['quantidade'];

		 if($nome == "" || $local == "" || $dataCadastro == "" || $status == "" ||
            $tipoServico == "" || $quantidade == ""){
            return false;
         } 

		 $this->servico->setNome($nome);
		 $this->servico->setLocal($local);
		 $this->servico->setDataCadastro($dataCadastro);
		 $this->servico->setStatus($status);
		 $this->servico->setTipoServico($tipoServico);
		 $this->servico->setQuantidade($quantidade);

		 return true;
    }
    
	
}

if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
    $controleCadastroServico = new ControleCadastroServico();
}


?>