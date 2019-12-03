<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOMarcenaria.php");

class ServiceRelatorioOSMarcenaria extends ServiceRelatorioOS {
    
    public function __construct(){
        parent::__construct();
        $this->ordemServicoDAO->instanceOfTipoServicoDAO(new TipoServicoDAOMarcenaria());
        $this->ordemServicoDAO->instanceOfServicoDAO(new ServicoDAOMarcenaria());
    }

    // Largura * 2, Comprimento * 1.5
    public function calcularEstimativas($relatorioOS){
        foreach ($relatorioOS->getOrdemServico() as $ordemServico){
            $tempoEstimadoTotal = 0;
            $tempoPorcentagemFerramenta = 0;
            $tempoLargura = 0;
            $tempoComprimento = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico ){
                $tempoLargura = $itemServico->getTipoServico()->getTempo() * 2;
                $tempoComprimento = $itemServico->getTipoServico()->getTempo() * 1.5;
                
                $tempo = ($tempoLargura + $tempoComprimento) * $itemServico->getQuantidade();
                $itemServico->setEstimativaTempoTotal($tempo - $tempoPorcentagemFerramenta);
            }
            $ordemServico->setTempoEstimadoTotal($tempoEstimadoTotal);
        }
        
        return $relatorioOS;
    }

}

?>