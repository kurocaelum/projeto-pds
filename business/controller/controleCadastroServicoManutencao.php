<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServicoManutencao.php");


class ControleCadastroServicoManutencao extends ControleCadastroServico{

	public function __construct(){
		
		$this->serviceServico = new ServiceServicoManutencao();
		$this->servico = new ServicoManutencao();
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
         $grau_dificuldade = $_POST['grau_dificuldade'];

         if($_POST['tempo_extra_fixo'] == "on"){
            $tempo_extra_fixo = 1;
         }else{
            $tempo_extra_fixo = 0;
         }
         
         $this->servico->setNome($nome);
         $this->servico->setLocal($local);
         $this->servico->setDataCadastro($dataCadastro);
         $this->servico->setStatus($status);
         $this->servico->setTipoServico($tipoServico);
         $this->servico->setQuantidade($quantidade);
         $this->servico->setTempoExecucao($tempo);
         $this->servico->setIsTempoExtraFixo($tempo_extra_fixo);
         $this->servico->setGrauDificuldade($grau_dificuldade);

    }


}

if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
    $controleCadastroServico = new ControleCadastroServicoManutencao();
}


?>