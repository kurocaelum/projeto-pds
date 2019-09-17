<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");

class ServicoDAO{
    private $arrayServicos;
    private $conexao;

    public function __construct(){
        $this->arrayServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($servico){
        
        $sql = "INSERT INTO servico (id_tipo_servico, nome, localizacao, quantidade, data_cadastro, status) VALUES (".$servico->getTipoServico().", '".$servico->getNome()."', '".$servico->getLocal()."', ".$servico->getQuantidade().", '".$servico->getDataCadastro()."', '".$servico->getStatus()."')";

        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar inserir o serviço no banco de dados.\n");
        }

        return true;
    }
     
    public function update($servico){
         $sql = "UPDATE servico SET id_tipo_servico = ".$servico->getTipoServico().", nome = '".$servico->getNome()."', localizacao = '".$servico->getLocal()."', quantidade = ".$servico->getQuantidade().", data_cadastro= '".$servico->getDataCadastro()."', status= '".$servico->getStatus()."'   WHERE  id_servico = ".$servico->getIdServico();
    
        
        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar atualizar o serviço no banco de dados.\n");
        }

        return true;
    }
     
    public function delete($servico){

        if($servico->getIdServico() != ""){

            $sql = "DELETE FROM servico WHERE id_servico=".$servico->getIdServico();
            if(mysqli_query($this->conexao, $sql) == 0){
                throw new DataException("Erro ao tentar remover o serviço no banco de dados.\n");
            }   
        }

        return true;
    }

    //retorna array de objetos de tipo_servicos
    public function getServicos(){
        $sql = "SELECT * FROM servico";
        $result = mysqli_query($this->conexao, $sql);
        
        if ($result) {
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $this->arrayServicos[count($this->arrayServicos) + 1] = $row;
                }
            }
             
        }else{

            throw new DataException("Erro ao tentar listar os serviços do banco de dados.\n");   
        }

        return $this->arrayServicos;
    }

    public function getServicoById($idServico){
        $sql = "SELECT * FROM servico WHERE id_servico = '".$idServico."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            return mysqli_fetch_object($result);
        }else{
            throw new DataException("Erro ao selecionar o serviço no banco de dados.\n");
        }
    }

}

?>