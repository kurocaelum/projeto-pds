<?php 

	include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroTipoServico.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServicoManutencao.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoManutencao.php");


	class ControleCadastroTipoServicoManutencao extends ControleCadastroTipoServico{

		public function __construct(){
			$this->serviceTipoServico = new ServiceTipoServicoManutencao();
			$this->tipoServico = new TipoServicoManutencao();
			parent::__construct();
		}

		public function setTipoServicoSecundario(){
	         $tempo_extra_fixo = $_POST['tempo_extra_fixo'];
			 $this->tipoServico->setTempoExtraFixo($tempo_extra_fixo);
		}

	}

	if(isset($_POST['idTipoServico']) || isset($_POST['listaTipoServicos']) || isset($_POST['excluirTipoServico']) || isset($_POST['addTipoServico']) ){
	    $controleCadastroTipoServico = new ControleCadastroTipoServicoManutencao();
	}
 ?>