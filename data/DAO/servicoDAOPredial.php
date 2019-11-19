<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOPredial.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoPredial.php");

class ServicoDAOPredial extends ServicoDAO{
    public function __construct(){
        $this->tipoServicoDAO = new TipoServicoDAOPredial();
        parent::__construct();
    }
    

    public function getObjectServico($row){
    	// echo "c";
    	// $row = mysqli_fetch_object($result);
        $servico = new ServicoPredial();
        $servico->setNome($row->nome);
        $servico->setIdServico($row->id_servico);
        $servico->setTipoServico($this->tipoServicoDAO->getTipoServicoById($row->id_tipo_servico));
        $servico->setQuantidade($row->quantidade);
        $servico->setLocal($row->localizacao);
        $servico->setDataCadastro($row->data_cadastro);
        $servico->setStatus($row->status);
        $servico->setTempoExecucao($row->tempo_conclusao);
        $servico->setQuantidadeAjudante($row->quantidade_ajudante);
        $servico->setRemocao($row->remocao);
       	// print_r($servico);

        return $servico;
    }

    public function insert($servico){
        
        $campos = "(id_tipo_servico, nome, localizacao, quantidade, data_cadastro, status, tempo_conclusao, quantidade_ajudante, remocao)";
        $valores = "(".$servico->getTipoServico().", '".$servico->getNome()."', '".$servico->getLocal()."', ".$servico->getQuantidade().", '".$servico->getDataCadastro()."', '".$servico->getStatus()."', ".$servico->getTempoExecucao().", '".$servico->getQuantidadeAjudante()."', ".$servico->getRemocao().")";

        $this->insertDAO($campos, $valores);
   
        return true;
    }




}

?>