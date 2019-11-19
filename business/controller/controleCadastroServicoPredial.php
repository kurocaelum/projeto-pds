<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoPredial.php");


class ControleCadastroServicoPredial extends ControleCadastroServico{

	public function __construct(){
		
		$this->serviceServico = new ServiceServicoPredial();
		$this->servico = new ServicoPredial();
		parent::__construct();
	}


    public function setServico(){

         $nome = $_POST['nome'];
         $local = $_POST['local'];
         $dataCadastro = $_POST['data'];
         $status = $_POST['status'];
         $tipoServico = $_POST['tipoServico'];
         $quantidade = $_POST['quantidade'];
         $tempo = $_POST['tempo'];
         $quantidade_ajudante = $_POST['quantidade_ajudante'];
         if($_POST['remocao'] == "on"){
            $remocao = 1;
         }else{
            $remocao = 0;
         }
         
         $this->servico->setNome($nome);
         $this->servico->setLocal($local);
         $this->servico->setDataCadastro($dataCadastro);
         $this->servico->setStatus($status);
         $this->servico->setTipoServico($tipoServico);
         $this->servico->setQuantidade($quantidade);
         $this->servico->setTempoExecucao($tempo);
         $this->servico->setRemocao($remocao);
         $this->servico->setQuantidadeAjudante($quantidade_ajudante);

    }


}

if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
    $controleCadastroServico = new ControleCadastroServicoPredial();
}


?>