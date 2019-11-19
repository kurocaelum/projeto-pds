<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");

abstract class ServicoDAO{
    public $arrayServicos;
    public $conexao;
    public $tipoServicoDAO;

    public function __construct(){
        $this->arrayServicos = [];
        $this->conexao = (new Conexao())->getConexao();
        // $this->tipoServicoDAO = new TipoServicoDAO();
    }
    

    
    public function insertDAO($campos, $values ){
        $sql = "INSERT INTO servico ".$campos." VALUES ".$values.";";
        
        // echo $sql;

        if(mysqli_query($this->conexao, $sql) == 0){
            throw new DataException("Erro ao tentar inserir o tipo de serviço no banco de dados.\n");
        }

        return true;
    }

     
    public function update($servico){
         $sql = "UPDATE servico SET id_tipo_servico = ".$servico->getTipoServico().", nome = '".$servico->getNome()."', localizacao = '".$servico->getLocal()."', quantidade = ".$servico->getQuantidade().", data_cadastro= '".$servico->getDataCadastro()."', status= '".$servico->getStatus()."', tempo_conclusao= ".$servico->getTempoExecucao()." WHERE  id_servico = ".$servico->getIdServico();
    
        
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
                while($row = mysqli_fetch_object($result)) {
                    // print_r($row);
                    $this->arrayServicos[count($this->arrayServicos) + 1] = $this->getObjectServico($row);;
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
            return $this->getObjectServico(mysqli_fetch_object($result));
        }else{
            throw new DataException("Erro ao selecionar o serviço no banco de dados.\n");
        }
    }

    abstract function getObjectServico($result);
    

}

?>