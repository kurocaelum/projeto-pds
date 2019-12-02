<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOManutencao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoManutencao.php");

class ServicoDAOManutencao extends ServicoDAO{
    public function __construct(){
        $this->tipoServicoDAO = new TipoServicoDAOManutencao();
        parent::__construct();
    }
    

    public function getObjectServico($row){
    	// echo "c";
    	// $row = mysqli_fetch_object($result);
        $servico = new ServicoManutencao();
        $servico->setNome($row->nome);
        $servico->setIdServico($row->id_servico);
        $servico->setTipoServico($this->tipoServicoDAO->getTipoServicoById($row->id_tipo_servico));
        $servico->setQuantidade($row->quantidade);
        $servico->setLocal($row->localizacao);
        $servico->setDataCadastro($row->data_cadastro);
        $servico->setStatus($row->status);
        $servico->setTempoExecucao($row->tempo_conclusao);
        $servico->setGrauDificuldade($row->grau_dificuldade);
        $servico->setIsTempoExtraFixo($row->tempo_extra_fixo);
       	// print_r($servico);

        return $servico;
    }

    public function insert($servico){
        
        $campos = "(id_tipo_servico, nome, localizacao, quantidade, data_cadastro, status, tempo_conclusao, tempo_extra_fixo, grau_dificuldade)";
        $valores = "(".$servico->getTipoServico().", '".$servico->getNome()."', '".$servico->getLocal()."', ".$servico->getQuantidade().", '".$servico->getDataCadastro()."', '".$servico->getStatus()."', ".$servico->getTempoExecucao().", '".$servico->getIsTempoExtraFixo()."', ".$servico->getGrauDificuldade().")";

        $this->insertDAO($campos, $valores);
   
        return true;
    }




}

?>