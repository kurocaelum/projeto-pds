<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Imprevisto.php");

class ImprevistoDAO{
    public $arrayImprevistos;
    public $conexao;

    public function __construct(){
        $this->arrayImprevistos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($imprevisto){
        $sql = "INSERT INTO imprevisto (servico, descricao, quantidade) VALUES ('".$imprevisto->getServico()."', '".$imprevisto->getDescricao()."', '".$imprevisto->getQuantidade()."') ";
    
        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar inserir o imprevisto no banco de dados.\n");
        }
    
        return true;
    }
     
    public function update($imprevisto){
         $sql = "UPDATE imprevisto SET servico = '".$imprevisto->getServico()."', descricao = '".$imprevisto->getDescricao()."', quantidade = '".$imprevisto->getQuantidade()."' WHERE  imprevisto.id_imprevisto = '".$imprevisto->getIdimprevisto()."'";
       
        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar atualizar o imprevisto no banco de dados.\n");
        }
    
        return true;
    }
     
    public function delete($imprevisto){
        if($imprevisto->getIdImprevisto() != ""){
            $sql = "DELETE FROM imprevisto WHERE idImprevisto=".$imprevisto->getIdImprevisto();
    
            if(mysqli_query($this->conexao, $sql) == 0){
                throw new DataException("Erro ao tentar remover o imprevisto no banco de dados.\n");
            }   
        }
    
        return true;
    }
    
    public function getImprevistos(){
        $sql = "SELECT * FROM imprevisto";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_object($result)) {
                    $imprevisto = new Imprevisto();
                    $imprevisto->setServico($row->servico);
                    $imprevisto->setDescricao($row->descricao);
                    $imprevisto->setQuantidade($row->quantidade);
                    
    
                    $this->arrayImprevistos[count($this->arrayImprevistos) + 1] = $imprevisto;
                }
                return $this->arrayImprevistos;
            }   
        }else{
            throw new DataException("Erro ao listar os imprevistos no banco de dados.\n");
        }
    }
}

?>