<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Imprevisto.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/servicoDAO.php");

class ImprevistoDAO{
    public $arrayImprevistos;
    public $conexao;
    public $servicoDAO;

    public function __construct(){
        $this->arrayImprevistos = [];
        $this->conexao = (new Conexao())->getConexao();
        $this->servicoDAO = new ServicoDAO();
    }
    
    public function insert($imprevisto){
        $sql = "INSERT INTO imprevisto (id_servico, descricao, quantidade) VALUES ('".$imprevisto->getServico()."', '".$imprevisto->getDescricao()."', '".$imprevisto->getQuantidade()."') ";
        echo "sql: ". $sql . "\n";
    
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao tentar inserir o imprevisto no banco de dados.\n");
        }
    }
     
    public function update($imprevisto){
         $sql = "UPDATE imprevisto SET id_servico = '".$imprevisto->getServico()."', descricao = '".$imprevisto->getDescricao()."', quantidade = '".$imprevisto->getQuantidade()."' WHERE  imprevisto.id_imprevisto = '".$imprevisto->getIdimprevisto()."'";
       
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao tentar atualizar o imprevisto no banco de dados.\n");
        }
    }
     
    public function delete($imprevisto){
        if($imprevisto->getIdImprevisto() != ""){
            $sql = "DELETE FROM imprevisto WHERE id_imprevisto=".$imprevisto->getIdImprevisto();
    
            if(!mysqli_query($this->conexao, $sql)){
                throw new DataException("Erro ao tentar remover o imprevisto no banco de dados.\n");
            }   
        }
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