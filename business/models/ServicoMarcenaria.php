<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");

class ServicoMarcenaria extends Servico{
    public $largura;
    public $comprimento;

    public function __construct(){
        
    }

    public function setLargura($largura){
        $this->largura = $largura;
    }

    public function getLargura($largura){
        return $this->largura;
    }

    public function setComprimento($comprimento){
        $this->comprimento = $comprimento;
    }

    public function getComprimento(){
        return $this->comprimento;
    }
}

?>