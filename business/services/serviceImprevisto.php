<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Imprevisto.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/imprevistoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/serviceException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");

class ServiceImprevisto{
    public $imprevistoDAO;

    public function __construct(){
        $this->imprevistoDAO = new ImprevistoDAO();
    }
    
    public function addImprevisto($imprevisto){
        try {
            $this->verificarImprevisto($imprevisto);
            $this->imprevistoDAO->insert($imprevisto);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }
    
    public function alterarImprevisto($imprevisto){
        try {
            // $this->verificarDataId($imprevisto);
            $this->verificarImprevisto($imprevisto);
            $this->imprevistoDAO->update($imprevisto);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }
    
    public function excluirImprevisto($imprevisto){
        try {
            // $this->verificarDataId($imprevisto);
            $this->imprevistoDAO->delete($imprevisto);
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
    }
    
    public function getListaImprevistos(){
        try {
            $retorno = $this->imprevistoDAO->getImprevistos();
        } catch (ServiceException $s) {
            throw $s;
        } catch (DataException $d) {
            throw $d;
        } 
        return $retorno;
    }
    
    // TODO Valida antes de inserir no banco
    public function verificarImprevisto($imprevisto){
        return true;
    }
    
    // TODO Checa pelo ID se está cadastrado no banco
    public function verificarDataId($imprevisto){
        return true;
    }
}

?>