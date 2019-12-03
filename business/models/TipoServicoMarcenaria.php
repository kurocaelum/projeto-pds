<?php 
include_once("TipoServico.php");

class TipoServicoMarcenaria extends TipoServico {
    public $porcentagemFerramenta;

    function setPorcentagemFerramenta($porcentagemFerramenta){
        $this->porcentagemFerramenta = $porcentagemFerramenta;
    }

    function getPorcentagemFerramenta(){
        return $this->porcentagemFerramenta;
    }
}

?>