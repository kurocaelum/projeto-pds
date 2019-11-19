<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServicoOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/data/DAO/tipoServicoDAOPredial.php");


public class ServiceRelatorioOSPredial extends ServiceRelatorioOS{
    
    public function __construct(){
        parent::__construct();
        $this->ordemServicoDAO->instanceOfTipoServicoDAO(new TipoServicoDAOPredial());
        $this->ordemServicoDAO->instanceOfServicoDAO(new ServicoDAOPredial());
        
    }


    public function calcularEstimativas($relatorioOS){ // calcula o tempo total estimado pela OS, soma o tempo estimado de cada serviço
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoEstimadoTotal = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico ) {
                $tempo = $itemServico->getTipoServico()->getTempo() * $itemServico->getQuantidade();
                $itemServico->setEstimativaTempoTotal($tempo);
                $tempoEstimadoTotal = $tempoEstimadoTotal + $tempo;
            }
            $ordemServico->setTempoEstimadoTotal($tempoEstimadoTotal);
        }
        return $relatorioOS;
    }


    
    
}


    
?>