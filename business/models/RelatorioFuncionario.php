<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");

class RelatorioFuncionario {
    public $funcionario;
    public $quantidadeOrdemServicos;
    public $porcentagemOrdemServicoExcesso;

	public function __construct(){
        $this->funcionario = new Funcionario();
    }

    public function setFuncionario($funcionario){
    	$this->funcionario = $funcionario;
    }
    public function getFuncionario(){
    	return $this->funcionario;
    }

    public function setQuantidadeOrdemServicos($qua){
    	$this->quantidadeOrdemServicos = $qua;
    }
    public function getQuantidadeOrdemServicos(){
    	return $this->quantidadeOrdemServicos;
    }

    public function setPorcentagemOrdemServicoExcesso($porc){
    	$this->porcentagemOrdemServicoExcesso = $porc;
    }
    public function getPorcentagemOrdemServicoExcesso(){
    	return $this->porcentagemOrdemServicoExcesso;
    }



}

	
 ?>