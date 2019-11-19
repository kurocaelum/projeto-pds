<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");


abstract class TipoServicoDAO{
    public $arrayTiposServicos;
    public $conexao;

    public function __construct(){
        $this->arrayTiposServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    //(nome, unidade_medida, tempo)
    //('".$tipoServico->getNome()."', '".$tipoServico->getUnidadeMedida()."', '".$tipoServico->getTempo()."')
    public function insertDAO($campos, $values ){
        $sql = "INSERT INTO tipo_servico ".$campos." VALUES ".$values.";";

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

    public function getTipoServicoById($idTipoServico){
        $sql = "SELECT * FROM tipo_servico WHERE id_tipo_servico = '".$idTipoServico."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            $row = mysqli_fetch_object($result);
            return $this->objectTipoServicoById($row);
        }else{
            throw new DataException("Erro ao selecionar o tipo de serviço no banco de dados.\n");
        }
    }

    abstract function objectTipoServicoById($result);

}

?>