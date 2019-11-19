<?php 

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/ordemServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");


abstract class ServiceRelatorioOS{
    public $ordemServicoDAO; // objeto dao para salvar as funcionarios e obter dados.
    // public $listaOrdemServicos;
    

    public function __construct(){
        $this->ordemServicoDAO = new OrdemServicoDAO();
    }

    public function calcularPorcentagemTempoServico($relatorioOS){// calcula a porcentagem de conclusao de cada servico individual
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            foreach ($ordemServico->getListaServicos() as $itemServico ) {
                $tempoExecucao = $itemServico->getTempoExecucao();
                if($tempoExecucao == "-1"){
                    $porcentagem = 0;
                }else{
                    $tempoEstimado = $itemServico->getEstimativaTempoTotal();
                    $porcentagem = $tempoExecucao * 100 / $tempoEstimado;
                }
                $itemServico->setPorcentagemTempo($porcentagem);
            }
        }
        return $relatorioOS;
    }

    abstract function calcularEstimativas($relatorioOS); // calcula o tempo total estimado pela OS, soma o tempo estimado de cada serviço

    public function calcularExecucaoTempo($relatorioOS){ // tempo total de execução da OS
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoReal = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico ) {
                $tempoReal = $tempoReal + $itemServico->getTempoExecucao();
            }
            $ordemServico->setTempoExecucaoTotal($tempoReal);
        }
        return $relatorioOS;
    }

    public function calcularPocentagemTempoUtilizado($relatorioOS){ // porcentagem do tempo previsto utilizado na OS
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoReal = $ordemServico->getTempoExecucaoTotal();
            $tempoEstimado = $ordemServico->getTempoEstimadoTotal();
            $ordemServico->setPocentagemTempoUtilizado(($tempoReal * 100 / $tempoEstimado));
        }
        return $relatorioOS;
    }

    public function calcularStatus($relatorioOS){ // calcula a porcentagem do tempo previsto dos serviços com status concluído
        foreach ($relatorioOS->getOrdemServico() as $ordemServico) { 
            $tempoPendente = 0;
            $tempoEstimado = 0;
            $tempoConcluido = 0;
            foreach ($ordemServico->getListaServicos() as $itemServico) { 

                if( $itemServico->getStatus() == "1"){
                    $tempoConcluido = $tempoConcluido + $itemServico->getEstimativaTempoTotal();
                }
                if( ($itemServico->getStatus() == "2") || ($ordemServico->getStatus() == "3")){
                     $tempoPendente = $tempoPendente + $itemServico->getEstimativaTempoTotal();
                }
            }

            if($tempoConcluido == 0){
                $ordemServico->setStatus(0);
            }else{
                $ordemServico->setStatus(($tempoConcluido * 100) / ($tempoPendente + $tempoConcluido));
            }

        }
        return $relatorioOS;
    }
    // public function addOrdemServico($ordemServico){
    //     try {
    //         $this->verificarOrdemServico($ordemServico);
    //         $this->ordemServicoDAO->insert($ordemServico);
    //     } catch (ServiceException $s) {
    //         throw $s;
    //     } catch (DataException $d) {
    //         throw $d;
    //     } 
    // }

    // public function alterarOrdemServico($ordemServico){
    //     try {
    //         $this->verificarDataId($ordemServico);
    //         $this->verificarOrdemServico($ordemServico);
    //         $this->ordemServicoDAO->update($ordemServico);
    //     } catch (ServiceException $s) {
    //         throw $s;
    //     } catch (DataException $d) {
    //         throw $d;
    //     } 
    // }

    // public function excluirOrdemServico($ordemServico){
    //     try {
    //         $this->verificarDataId($ordemServico);
    //         $this->ordemServicoDAO->delete($ordemServico);
    //     } catch (ServiceException $s) {
    //         throw $s;
    //     } catch (DataException $d) {
    //         throw $d;
    //     } 
    // }

    public function getListaOrdemServico(){
        try {
            $retorno = $this->ordemServicoDAO->getOrdemServicos();
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
        return $retorno;
    }

    // //verifica se o funcionário está cadastrado, caso contrário retorna exceção
    // public function verificarDataId($ordemServico){
    //     // echo $this->ordemServicoDAO->getFuncionarioById($funcionario->getIdFuncionario());
    //     // echo "string";
    //     // if(count($this->ordemServicoDAO->getOrdemServicoById($ordemServico->getIdOrdemServico())) == 0){
    //         // throw new ServiceException("Ordem de serviço não encontrado.");
    //     // }
    // }

    // public function verificarOrdemServico($ordemServico){
    //     // $ret = "";

    //     // if($funcionario->getNome() == ""){
    //     //     $ret = $ret."Nome não informado.\n";
    //     // }

    //     // if($funcionario->getEmail() == ""){
    //     //     $ret = $ret."Email não informado.\n";
    //     // }else{
    //     //     if(count($this->ordemServicoDAO->getFuncionarioByEmail($funcionario->getEmail())) != 0){
    //     //         throw new ServiceException("Email já cadastrado.");
    //     //     }
    //     // }
        
    //     // if($funcionario->getTelefone() == ""){
    //     //     $ret = $ret."Telefone não informado.\n";
    //     // }

    //     // if($funcionario->idSupervisorChefe() != ""){
    //     //     if($funcionario->idSupervisorChefe() == $funcionario->idFuncionario()){
    //     //         $ret = $ret."ID chefe igual ao ID do funcionário.\n";
    //     //     }
    //     // }

    //     // if($ret != ""){
    //     //     throw new ServiceException($ret);
    //     // }
    // }



    
    
}


    
?>