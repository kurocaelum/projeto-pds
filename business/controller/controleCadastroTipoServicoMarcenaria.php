<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroTipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceTipoServicoMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoMarcenaria.php");

    class ControleCadastroTipoServicoMarcenaria extends ControleCadastroTipoServico {
        public function __construct(){
            $this->serviceTipoServico = new ServiceTipoServicoMarcenaria();
            $this->tipoServico = new TipoServicoMarcenaria();
            parent::__construct();
        }

        public function setTipoServicoSecundario(){
            $porcentagem_ferramenta = $_POST['porcentagem_ferramenta'];
            $this->tipoServico->setPorcentagemFerramenta($porcentagem_ferramenta);
        }
    }

    if(isset($_POST['idTipoServico']) || isset($_POST['listaTipoServicos']) || isset($_POST['excluirTipoServico']) || isset($_POST['addTipoServico']) ){
	    $controleCadastroTipoServico = new ControleCadastroTipoServicoMarcenaria();
	}

?>