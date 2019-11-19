<?php 
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/RelatorioFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroFuncionario.php");

// include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/ordemServicoDAO.php");
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");


class ControleRelatorioFuncionario extends ControleRelatorioOS{
    // public $listaRelatorioFuncionario;
    public $serviceRelatorioFuncionario;
    public $relatoriosFuncionario;
    public $listaFuncionarios;
    public $controleCadastroFuncionario;

    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioFuncionario = new ServiceRelatorioFuncionario(); 
        $this->controleCadastroFuncionario = new ControleCadastroFuncionario();
        $this->relatoriosFuncionario = [];
    }

    public function carregarFuncionarios(){
        $this->listaFuncionarios = $this->controleCadastroFuncionario->listarFuncionarios();
    }

    public function gerarRelatorioFuncionarios(){   
        $contRelatorio = 0;
        foreach ($this->listaFuncionarios as $funcionario) {
            $itemRelatorioFuncionario = null;
            $itemRelatorioFuncionario = new RelatorioFuncionario();
            $itemRelatorioFuncionario->setFuncionario($funcionario);



            $itemRelatorioFuncionario->setQuantidadeOrdemServicos( $this->calcularQuantidadeOrdemServicos($funcionario) );
            $itemRelatorioFuncionario->setPorcentagemOrdemServicoExcesso( $this->calcularPorcentagemOrdemServicoExcesso($funcionario) );

            $this->relatoriosFuncionario[$contRelatorio] = $itemRelatorioFuncionario;
            $contRelatorio += 1;
        }
        // $this->relatoriosFuncionario = $this->serviceRelatorioFuncionario->tratarDadosFuncionarios($this->listaFuncionarios, $this->getRelatorioOS());
    }

    public function calcularQuantidadeOrdemServicos($funcionario){
        return $this->serviceRelatorioFuncionario->calcularQuantidadeOrdemServicos($funcionario, $this->getRelatorioOS());
    }

    public function calcularPorcentagemOrdemServicoExcesso($funcionario){
        return $this->serviceRelatorioFuncionario->calcularPorcentagemOrdemServicoExcesso($funcionario, $this->getRelatorioOS());
    }

    public function getRelatorioFuncionarios(){
        return $this->relatoriosFuncionario;
    }


}



    
?>