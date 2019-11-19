<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoPredial.php");


class TipoServicoDAOPredial extends TipoServicoDAO{
	public $campos = "(nome, unidade_medida, tempo, tempo_remocao, porcentagem_ajudante)";


    public function insert($tipoServico){
    	$values = "('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."', '".$tipoServico->getTempoRemocao()."', '".$tipoServico->getPorcentagemAjudante()."')";
    	// print_r($values);
    	// echo "=====";
       	parent::insertDAO($this->campos, $values);  
    }
    
    public function objectTipoServicoById($row){
            $tipoServico = new TipoServicoPredial();
            $tipoServico->setNome( $row->nome );
            $tipoServico->setUnidadeMedida( $row->unidade_medida );
            $tipoServico->setIdTipoServico( $row->id_tipo_servico );
            $tipoServico->setTempo( $row->tempo );

            return $tipoServico;
     }

     
}


 ?>