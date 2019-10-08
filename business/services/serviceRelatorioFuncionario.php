<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");
// include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");


class ServiceRelatorioFuncionario{

    public function __construct(){
    }



    public function calcularQuantidadeOrdemServicos($funcionario, $relatorioOS){
        $total = 0;
        foreach ($relatorioOS->getOrdemServico() as $relatorio) {

            foreach ($relatorio->listaFuncionarios as $itemListaFuncionario) {
                if($itemListaFuncionario->idFuncionario == $funcionario->idFuncionario){
                    $total += 1;
                }
            }
        }
        return $total;
    }

    public function calcularPorcentagemOrdemServicoExcesso($funcionario, $relatorioOS){
        $teste = 0;
        $totalExcesso = 0;
        $totalPrazo = 0;
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) {
            $teste = 0;
            foreach ($ordemServico->listaFuncionarios as $itemListaFuncionario) {
                if($itemListaFuncionario->idFuncionario == $funcionario->idFuncionario){
                    $teste = 1;
                    break;
                }
            }
            if($teste == 1){
                if($ordemServico->pocentagemTempoUtilizado > 100){
                    $totalExcesso += 1;
                }else{
                    $totalPrazo += 1;
                }
            }
        }
        if(($totalPrazo + $totalExcesso) == 0){
            return 0;
        }
        return $totalExcesso * 100 / ($totalPrazo + $totalExcesso);
    }


    
    
}


    
?>