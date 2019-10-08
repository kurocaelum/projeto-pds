<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");

class RelatorioFuncionario {
    public $funcionario;
    public $quantidadeOrdemServicos;
    public $porcentagemOrdemServicoExcesso;

	public function __construct(){
    }

    public function setFuncionario($funcionario){
    	$this->funcionario = $funcionario;
    }
    public function getFuncionario(){
    	return $this->funcionario;
    }

    public function setQuantidadeOrdemServicos($quantidadeOrdemServicos){
    	$this->$quantidadeOrdemServicos = $quantidadeOrdemServicos;
    }
    public function getQuantidadeOrdemServicos(){
    	return $this->quantidadeOrdemServicos;
    }

    public function setPorcentagemOrdemServicoExcesso($porcentagemOrdemServicoExcesso){
    	$this->$porcentagemOrdemServicoExcesso = $porcentagemOrdemServicoExcesso;
    }
    public function getPorcentagemOrdemServicoExcesso(){
    	return $this->porcentagemOrdemServicoExcesso;
    }



}

	
 ?>