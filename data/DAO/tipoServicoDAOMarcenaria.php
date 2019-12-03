<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoMarcenaria.php");

class TipoServicoDAOMarcenaria extends TipoServicoDAO {
    public $campos = "(nome, unidade_medida, tempo, porcentagem_ferramenta)";

    public function insert($tipoServico){
    	$values = "('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."', '".$tipoServico->getPorcentagemFerramenta()."')";
    	// print_r($values);
    	// echo "=====";
       	parent::insertDAO($this->campos, $values);  
    }

    public function objectTipoServicoById($row){
        $tipoServico = new TipoServicoMarcenaria();
        $tipoServico->setNome( $row->nome );
        $tipoServico->setUnidadeMedida( $row->unidade_medida );
        $tipoServico->setIdTipoServico( $row->id_tipo_servico );
        $tipoServico->setTempo( $row->tempo );
        $tipoServico->setPorcentagemFerramenta( $row->porcentagem_ferramenta );

        return $tipoServico;
    }


}

?>