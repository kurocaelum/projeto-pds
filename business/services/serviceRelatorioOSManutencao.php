<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceOrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAOManutencao.php");


class ServiceRelatorioOSManutencao extends ServiceRelatorioOS{
    
    public function __construct(){
        parent::__construct();
        $this->ordemServicoDAO->instanceOfTipoServicoDAO(new TipoServicoDAOManutencao());
        $this->ordemServicoDAO->instanceOfServicoDAO(new ServicoDAOManutencao());
        
    }


    public function calcularEstimativas($relatorioOS){ // calcula o tempo total estimado pela OS, soma o tempo estimado de cada serviço
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoEstimadoTotal = 0;
            $tempoFixo = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico ) {
                if($itemServico->getIsTempoExtraFixo() == 1){
                    $tempoEstimadoTotal = $itemServico->getTipoServico()->getTempoExtraFixo();
                }
                $tempo = $itemServico->getTipoServico()->getTempo() * $itemServico->getQuantidade();
                if($itemServico->getGrauDificuldade() >= 1){
                    $tempo = $tempo + ($tempo * ($itemServico->getGrauDificuldade() * 10) / 100);
                }
                $itemServico->setEstimativaTempoTotal($tempo + $tempoEstimadoTotal);
                $tempoEstimadoTotal = $tempoEstimadoTotal + $tempo + $tempoEstimadoTotal;
                // }
            }
            $ordemServico->setTempoEstimadoTotal($tempoEstimadoTotal);
        }
        return $relatorioOS;
    }


    
    
}


    
?>