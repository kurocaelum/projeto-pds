<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");

class RelatorioOS {
    public $ordemServico;
    // public $listaServicos;
    public $quantidadeServicos;
    public $porcentagemTempo;
    public $tempoAtraso;

	public function __construct(){
		// $this->$ordemServico
        // $this->funcionariosAdministrados = [];
    }

    public function setOrdemServico($ordemServico){
    	$this->ordemServico = $ordemServico;
    }

    public function getOrdemServico(){
    	return $this->ordemServico;
    }

    // public function setListaServicos($listaServicos){
    // 	$this->$listaServicos = $listaServicos;
    // }

    // public function getListaServicos(){
    // 	return $this->listaServicos;
    // }

    public function setQuantidadeServicos($quantidadeServicos){
    	$this->$quantidadeServicos = $quantidadeServicos;
    }

    public function getQuantidadeServicos(){
    	return $this->quantidadeServicos;
    }

    public function setPorcentagemTempo($porcentagemTempo){
    	$this->$porcentagemTempo = $porcentagemTempo;
    }

    public function getPorcentagemTempo(){
    	return $this->porcentagemTempo;
    }

    public function setTempoAtraso($tempoAtraso){
    	$this->$tempoAtraso = $tempoAtraso;
    }

    public function getTempoAtraso(){
    	return $this->tempoAtraso;
    }



}

	
 ?>