<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceRelatorioOSPredial.php");

class ControleRelatorioOSPredial extends ControleRelatorioOS{


    public function __construct(){
        parent::__construct();
        $this->serviceRelatorioOS = new ServiceRelatorioOSPredial();
    }



}



    
?>