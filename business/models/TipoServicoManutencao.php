<?php 
include_once("TipoServico.php");

class TipoServicoManutencao extends TipoServico{
	public $tempoExtraFixo;

	function setTempoExtraFixo($tempoExtraFixo){
		$this->tempoExtraFixo = $tempoExtraFixo;
	}

	function getTempoExtraFixo(){
		return $this->tempoExtraFixo;
	}


}


 ?>