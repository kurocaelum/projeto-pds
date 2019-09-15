<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");


class TipoServicoDAO{
    public $arrayTiposServicos;
    public $conexao;

    public function __construct(){
        $this->arrayTiposServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($tipoServico){
        $sql = "INSERT INTO tipo_servico (nome, unidade_medida, tempo) VALUES ('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."') ";

        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar inserir o tipo de serviço no banco de dados.\n");
        }

        return true;
    }
     
    public function update($tipoServico){
         $sql = "UPDATE tipo_servico SET nome = '".$tipoServico->getNome()."', unidade_medida = '".$tipoServico->getUnidadeMedida()."', tempo = '".$tipoServico->getTempo()."' WHERE  tipo_servico.id_tipo_servico = '".$tipoServico->getIdTipoServico()."'";
       
        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar atualizar o tipo de serviço no banco de dados.\n");
        }

        return true;
    }
     
    public function delete($tipoServico){
        if($tipoServico->getIdTipoServico() != ""){
            $sql = "DELETE FROM tipo_servico WHERE id_tipo_servico=".$tipoServico->getIdTipoServico();

            if(mysqli_query($this->conexao, $sql) == 0){
                throw new DataException("Erro ao tentar remover o tipo de serviço no banco de dados.\n");
            }   
        }

        return true;
    }

    //retorna array de objetos de tipo_servicos
    public function getTiposServicos(){
        $sql = "SELECT * FROM tipo_servico";
        $result = mysqli_query($this->conexao, $sql);

        if($result){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arrayTiposServicos[count($this->arrayTiposServicos) + 1] = $row;
                }
               
            }
        }else{

            throw new DataException("Erro ao tentar listar os tipos de serviço do banco de dados.\n");
        }
         return $this->arrayTiposServicos;
    }

}

?>