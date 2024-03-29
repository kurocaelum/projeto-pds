<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOPredial.php");


class ServiceRelatorioOSPredial extends ServiceRelatorioOS{
    
    public function __construct(){
        parent::__construct();
        $this->ordemServicoDAO->instanceOfTipoServicoDAO(new TipoServicoDAOPredial());
        $this->ordemServicoDAO->instanceOfServicoDAO(new ServicoDAOPredial());
        
    }


    public function calcularEstimativas($relatorioOS){ // calcula o tempo total estimado pela OS, soma o tempo estimado de cada serviço
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoEstimadoTotal = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico ) {
                $tempo_remocao = 0;
                $tempoPorcentagemAjudante = 0;

                if($itemServico->getRemocao() == 1){
                   $tempo_remocao = $itemServico->getTipoServico()->getTempoRemocao() * $itemServico->getQuantidade();
                }else{
                    // echo "  n ";
                }
                $tempo = $itemServico->getTipoServico()->getTempo() * $itemServico->getQuantidade();
                $tempo = $tempo + $tempo_remocao;
                // echo $tempo_remocao;
                
                if($itemServico->getQuantidadeAjudante() > 0){
                    $tempoPorcentagemAjudante = (($itemServico->getTipoServico()->getPorcentagemAjudante()) * $tempo / 100) * $itemServico->getQuantidadeAjudante();
                    // echo $tempoPorcentagemAjudante;
                    // echo " ";
                    // echo $tempo;
                }else{
                    // echo " a ";
                }

                $itemServico->setEstimativaTempoTotal($tempo - $tempoPorcentagemAjudante);
                $tempoEstimadoTotal = $tempoEstimadoTotal + $tempo- $tempoPorcentagemAjudante;
            }
            $ordemServico->setTempoEstimadoTotal($tempoEstimadoTotal);
        }
        return $relatorioOS;
    }


    
    
}


    
?>