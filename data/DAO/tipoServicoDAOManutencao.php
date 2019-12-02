<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServicoManutencao.php");


class TipoServicoDAOManutencao extends TipoServicoDAO{
	public $campos = "(nome, unidade_medida, tempo, tempo_extra_fixo)";


    public function insert($tipoServico){
    	$values = "('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."', '".$tipoServico->getTempoExtraFixo()."')";
    	// print_r($values);
    	// echo "=====";
       	parent::insertDAO($this->campos, $values);  
    }
    
    public function objectTipoServicoById($row){
            $tipoServico = new TipoServicoManutencao();
            $tipoServico->setNome( $row->nome );
            $tipoServico->setUnidadeMedida( $row->unidade_medida );
            $tipoServico->setIdTipoServico( $row->id_tipo_servico );
            $tipoServico->setTempo( $row->tempo );
            $tipoServico->setTempoExtraFixo( $row->tempo_extra_fixo );
            // $tipoServico->setPorcentagemAjudante( $row->porcentagem_ajudante );

            return $tipoServico;
     }

     
}


 ?>