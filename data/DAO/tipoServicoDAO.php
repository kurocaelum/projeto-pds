<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");

class TipoServicoDAO{
    public $arrayTiposServicos;
    public $conexao;

    public function __construct(){
        $this->arrayTiposServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($tipoServico){
        $sql = "INSERT INTO tipo_servico (nome, unidade_medida, tempo) VALUES ('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."') ";
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function update($tipoServico){
         $sql = "UPDATE tipo_servico SET nome = '".$tipoServico->getNome()."', unidade_medida = '".$tipoServico->getUnidadeMedida()."', tempo = '".$tipoServico->getTempo()."' WHERE  tipo_servico.id_tipo_servico = '".$tipoServico->getIdTipoServico()."'";
        // echo $sql;
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function delete($tipoServico){
        if($tipoServico->getIdTipoServico() != ""){
            $sql = "DELETE FROM tipo_servico WHERE id_tipo_servico=".$tipoServico->getIdTipoServico();
            if(mysqli_query($this->conexao, $sql)){
                return 1;
            }
        }
        return 0;
    }

    //retorna array de objetos de tipo_servicos
    public function getTiposServicos(){
        $sql = "SELECT * FROM tipo_servico";
        $result = mysqli_query($this->conexao, $sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arrayTiposServicos[count($this->arrayTiposServicos) + 1] = $row;
                }
                return $this->arrayTiposServicos;
            }   
        return 0;
    }

}

?>