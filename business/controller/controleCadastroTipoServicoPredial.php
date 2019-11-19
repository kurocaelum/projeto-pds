<?php 

	include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroTipoServico.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServicoPredial.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoPredial.php");


	class ControleCadastroTipoServicoPredial extends ControleCadastroTipoServico{

		public function __construct(){
			$this->serviceTipoServico = new ServiceTipoServicoPredial();
			$this->tipoServico = new TipoServicoPredial();
			parent::__construct();
		}

	    public function setTipoServicoSecundario(){

	         $tempo_remocao = $_POST['tempo_remocao'];
	         $porcentagem_ajudante = $_POST['porcentagem_ajudante'];

	         $this->tipoServico->setPorcentagemAjudante($porcentagem_ajudante);
	         $this->tipoServico->setTempoRemocao($tempo_remocao);
	    }



	}

	if(isset($_POST['idTipoServico']) || isset($_POST['listaTipoServicos']) || isset($_POST['excluirTipoServico']) || isset($_POST['addTipoServico']) ){
	    $controleCadastroTipoServico = new ControleCadastroTipoServicoPredial();
	}
 ?>