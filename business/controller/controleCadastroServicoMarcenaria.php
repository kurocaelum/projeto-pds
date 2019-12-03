<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServicoMarcenaria.php");

class ControleCadastroServicoMarcenaria extends ControleCadastroServico {
    public function __construct(){
        $this->serviceServico = new ServiceServicoMarcenaria();
        $this->servico = new ServicoMarcenaria();
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

        $largura = $_POST['largura'];
        $comprimento = $_POST['comprimento'];
        
        $this->servico->setNome($nome);
        $this->servico->setLocal($local);
        $this->servico->setDataCadastro($dataCadastro);
        $this->servico->setStatus($status);
        $this->servico->setTipoServico($tipoServico);
        $this->servico->setQuantidade($quantidade);
        $this->servico->setTempoExecucao($tempo);
        
        $this->servico->setLargura($largura);
        $this->servico->setComprimento($comprimento);
   }

}

if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
    $controleCadastroServico = new ControleCadastroServicoMarcenaria();
}

?>