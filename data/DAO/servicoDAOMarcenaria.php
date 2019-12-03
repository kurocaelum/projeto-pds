<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAOMarcenaria.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/ServicoMarcenaria.php");

class ServicoDAOMarcenaria extends ServicoDAO {
    public function __construct(){
        $this->tipoServicoDAO = new TipoServicoDAOMarcenaria();
        parent::__construct();
    }

    public function getObjectServico($row){
    	// echo "c";
    	// $row = mysqli_fetch_object($result);
        $servico = new ServicoMarcenaria();
        $servico->setNome($row->nome);
        $servico->setIdServico($row->id_servico);
        $servico->setTipoServico($this->tipoServicoDAO->getTipoServicoById($row->id_tipo_servico));
        $servico->setQuantidade($row->quantidade);
        $servico->setLocal($row->localizacao);
        $servico->setDataCadastro($row->data_cadastro);
        $servico->setStatus($row->status);
        $servico->setTempoExecucao($row->tempo_conclusao);
        
        $servico->setLargura($row->largura);
        $servico->setComprimento($row->comprimento);
       	// print_r($servico);

        return $servico;
    }

}


?>