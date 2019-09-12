<?php 
// controlador da parte do gerenciamento de TipoServico. Essa classe recebe os dados do html, faz a //validação dos dados, encapsula-os em um objeto TipoServico e envia para serviceTipoServico

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServico.php");


class ControleCadastroTipoServico{

	public $serviceTipoServico;
	public $tipoServico;

	public function __construct(){
		$this->serviceTipoServico = new ServiceTipoServico();
		$this->tipoServico = new TipoServico();
        $this->verificarRequisicao();
	}

    public function verificarRequisicao(){

        if(isset($_POST['idTipoServico'])){

            if($_POST['idTipoServico'] != ""){
                $this->alterarTipoServico();
            }else{
                if(isset($_POST['addTipoServico'])){
                    $this->addTipoServico();  
                }
            }
        }
        if(isset($_POST['listaTipoServicos'])){
            $this->getListaTipoServicos();
        }
        if(isset($_POST['excluirTipoServico'])){
            $this->excluirTipoServico();
        }
        
    }


    public function addTipoServico($tipoServico){
    	if(!$this->validarDadosTipoServico()){
            return false;
        }

        return $this->serviceTipoServico->addTipoServico($this->tipoServico);
    }

    public function alterarTipoServico($tipoServico){
    	if(!$this->validarDadosTipoServico()){
            return false;
        }
        $this->tipoServico->setIdTipoServico($_POST['idTipoServico']);

        return $this->serviceTipoServico->alterarTipoServico($this->tipoServico);
    }

    public function excluirTipoServico($tipoServico){
    	$this->validarDadosTipoServico();
        $this->tipoServico->setIdTipoServico($_POST['idTipoServico']);

        return $this->serviceTipoServico->excluirTipoServico($this->tipoServico); 
    }


    public function getListaTipoServicos(){
    	return $this->serviceTipoServico->getListaTipoServicos();
    }

    public function validarDadosTipoServico(){

         $nome = $_POST['nome'];
         $unidade = $_POST['unidade'];
         $tempo = $_POST['tempo'];


         if($nome == "" || $unidade == "" || $tempo == ""){
            return false;
         } 

         $this->tipoServico->setNome($nome);
         $this->tipoServico->setUnidadeMedida($unidade);
         $this->tipoServico->setTempo($tempo);

         return true;
    }
    
    
}

if(isset($_POST['idTipoServico']) || isset($_POST['listaTipoServicos']) || isset($_POST['excluirTipoServico']) || isset($_POST['addTipoServico']) ){
    $controleCadastroTipoServico = new ControleCadastroTipoServico();
}



    
	
}

	
 ?>