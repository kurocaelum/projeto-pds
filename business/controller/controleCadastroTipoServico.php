<?php 
// controlador da parte do gerenciamento de TipoServico. Essa classe recebe os dados do html, faz a //validação dos dados, encapsula-os em um objeto TipoServico e envia para serviceTipoServico

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServico.php");


abstract class ControleCadastroTipoServico{

	public $serviceTipoServico;
	public $tipoServico;

	public function __construct(){
		// $this->serviceTipoServico = new ServiceTipoServico();
		// $this->tipoServico = new TipoServico();
        $this->verificarRequisicao();
}

    public function verificarRequisicao(){
        if(isset($_POST['idTipoServico'])){

            if($_POST['idTipoServico'] != ""){
                echo $this->alterarTipoServico();
            }else{
                if(isset($_POST['addTipoServico'])){
                    echo $this->addTipoServico();  
                }
            }
        }
        if(isset($_POST['listaTipoServicos'])){
            echo json_encode($this->getListaTipoServicos(), JSON_PRETTY_PRINT);
        }
        if(isset($_POST['excluirTipoServico'])){
            echo $this->excluirTipoServico();
        }
        
    }

    private function setTipoServico(){

         $nome = $_POST['nome'];
         $unidade = $_POST['unidade'];
         $tempo = $_POST['tempo'];

         $this->tipoServico->setNome($nome);
         $this->tipoServico->setUnidadeMedida($unidade);
         $this->tipoServico->setTempo($tempo);
         $this->setTipoServicoSecundario();
    }

    abstract function setTipoServicoSecundario();



    public function addTipoServico(){

        $this->setTipoServico();
       
        try {
             return $this->serviceTipoServico->addTipoServico($this->tipoServico);
            
        } catch (DataException | ServiceException $e) {
            return $e->getMessage();
        }   
    }

    public function alterarTipoServico(){
    	
        $this->setTipoServico();
        $this->tipoServico->setIdTipoServico($_POST['idTipoServico']);

        try {
            return $this->serviceTipoServico->alterarTipoServico($this->tipoServico);
            
        } catch (DataException | ServiceException $e) {
            return $e->getMessage();
        }   

        
    }

    public function excluirTipoServico(){
    	
        $this->tipoServico->setIdTipoServico($_POST['excluirTipoServico']);

        try {
            return $this->serviceTipoServico->excluirTipoServico($this->tipoServico);
            
        } catch (DataException | ServiceException $e) {
            return $e->getMessage();
        }   

        
    }


    public function getListaTipoServicos(){

        try {
            return $this->serviceTipoServico->getListaTipoServicos();
            
        } catch (DataException | ServiceException $e) {
            return $e->getMessage();
        }   
    	
    }
    
    
}



	
 ?>