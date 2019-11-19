<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/RelatorioOS.php");

include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/ordemServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOS.php");
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceServico.php");


abstract class ControleRelatorioOS{
    public $serviceRelatorioOS;
    public $serviceOrdemServico;
    // public $serviceServico;
    public $relatorioOS;

    public function __construct(){
        $this->serviceOrdemServico = new ServiceOrdemServico();
        // $this->serviceServico = new ServiceServico();
        // $this->serviceRelatorioOS = new ServiceRelatorioOS();
        $this->relatorioOS = new RelatorioOS();
    }

    public function carregarOrdemServico($idOrdemServico){
        if($idOrdemServico != -1){
            $ordemServico[0] = $this->serviceOrdemServico->getOrdemServicoById($idOrdemServico);
        }else{
            $ordemServico = $this->serviceOrdemServico->getListaOrdemServico();
        }

        $this->relatorioOS->setOrdemServico($ordemServico);
    }


    public function gerarRelatorioOS($idOrdemServico){
        $this->carregarOrdemServico($idOrdemServico);
        $this->relatorioOS = $this->serviceRelatorioOS->calcularEstimativas($this->relatorioOS);
        $this->relatorioOS = $this->serviceRelatorioOS->calcularExecucaoTempo($this->relatorioOS);    
        $this->relatorioOS = $this->serviceRelatorioOS->calcularPocentagemTempoUtilizado($this->relatorioOS);   
        $this->relatorioOS = $this->serviceRelatorioOS->calcularStatus($this->relatorioOS); 
        $this->relatorioOS = $this->serviceRelatorioOS->calcularPorcentagemTempoServico($this->relatorioOS);
        

    }


    public function getRelatorioOS(){
        return $this->relatorioOS;
    }



}



    
?>