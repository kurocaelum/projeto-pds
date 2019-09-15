<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/OrdemServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Servico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");

class OrdemServicoDAO{
    public $arrayOrdemServicos;
    public $conexao;

    public function __construct(){
        $this->arrayOrdemServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($ordemServico){
        $sql = "INSERT INTO ordem_servico (descricao) VALUES ('".$ordemServico->getDescricao()."') ";
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao inserir a ordem de serviço no banco de dados.\n");
        }else{
            $id_ordem_servico = mysqli_insert_id($this->conexao);
            $ordemServico->setIdOrdemServico($id_ordem_servico);
            $this->insertRelFuncionarioOs($ordemServico);
            $this->insertRelServicoOs($ordemServico);
        }

    }

    public function insertRelFuncionarioOs($ordemServico){
        foreach ($ordemServico->getListaFuncionarios() as $funcionario) {
            $sql2 = "INSERT INTO funcionarios_os (id_funcionario, id_ordem_servico) VALUES ('".$funcionario."', '".$ordemServico->getIdOrdemServico()."') ";      
            if(!mysqli_query($this->conexao, $sql2)){
                throw new DataException("Erro ao inserir a ordem de serviço no banco de dados.\n");
            }
        }
    }

    public function insertRelServicoOs($ordemServico){
        foreach ($ordemServico->getListaServicos() as $servico) {
            $sql2 = "INSERT INTO servico_os (id_servico, id_ordem_servico) VALUES ('".$servico."', '".$ordemServico->getIdOrdemServico()."') ";      
            if(!mysqli_query($this->conexao, $sql2)){
                throw new DataException("Erro ao inserir a ordem de serviço no banco de dados.\n");
            }
        }
    }
     
    public function update($ordemServico){
        $sql = "UPDATE ordem_servico SET descricao = '".$ordemServico->getDescricao()."' WHERE  ordem_servico.id_ordem_servico = '".$ordemServico->getIdOrdemServico()."'";
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao atualizar o funcionário no banco de dados.\n");
        }else{
            $this->deleteRelFuncionarioOS($ordemServico);
            $this->deleteRelServicoOS($ordemServico);
            $this->insertRelServicoOs($ordemServico);
            $this->insertRelFuncionarioOs($ordemServico);
        }

    }
     
    public function delete($ordemServico){
        $sql = "DELETE FROM ordem_servico WHERE id_ordem_servico = ".$ordemServico->getIdOrdemServico();
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao remover a ordem de serviço do banco de dados.\n");
        }
    }

    public function deleteRelFuncionarioOS($ordemServico){
        $sql = "DELETE FROM funcionarios_os WHERE id_ordem_servico = ".$ordemServico->getIdOrdemServico();
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao remover a ordem de serviço do banco de dados.\n");
        }
    }

    public function deleteRelServicoOS($ordemServico){
        $sql = "DELETE FROM servico_os WHERE id_ordem_servico = ".$ordemServico->getIdOrdemServico();
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao remover a ordem de serviço do banco de dados.\n");
        }
    }

    //retorna array de objetos de ordem servico
    public function getOrdemServicos(){
        $sql = "SELECT * FROM ordem_servico";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_object($result)) { 
                    $ordemServico = new OrdemServico();
                    $ordemServico->setDescricao($row->descricao);
                    $ordemServico->setIdOrdemServico($row->id_ordem_servico);

                    $listaServicos = $this->getServicosByOrdemServico($row->id_ordem_servico);
                    $listaFuncionarios = $this->getFuncionariosByOrdemServico($row->id_ordem_servico);
                    
                    for ($i=0; $i < count($listaServicos); $i++) { 
                        $ordemServico->addServico($listaServicos[$i]);
                    }   
                    for ($i=0; $i < count($listaFuncionarios); $i++) { 
                        $ordemServico->addFuncionario($listaFuncionarios[$i]);
                    } 

                    $this->arrayOrdemServicos[count($this->arrayOrdemServicos)] = $ordemServico;

                }
                return $this->arrayOrdemServicos;
            }   
        }else{
            throw new DataException("Erro ao listar as ordens de serviço no banco de dados.\n");
        }
    }
    public function getServicosByOrdemServico($id_ordem_servico){
        $servicos = [];
        $servicos_cont = 0;
        $sql = "SELECT * FROM servico_os WHERE id_ordem_servico = '".$id_ordem_servico."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_object($result)) {
                    $servicos[$servicos_cont] = $row->id_servico;
                    $servicos_cont += 1; 
                }
                return $servicos;
            }   
        }else{
            throw new DataException("Erro ao listar as ordens de serviço no banco de dados.\n");
        }
    }

    public function getFuncionariosByOrdemServico($id_ordem_servico){
        $funcionarios = [];
        $funcionario_cont = 0;
        $sql = "SELECT * FROM funcionarios_os WHERE id_ordem_servico = '".$id_ordem_servico."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_object($result)) {
                    $funcionarios[$funcionario_cont] = $row->id_funcionario;
                    $funcionario_cont += 1; 
                }
                return $funcionarios;
            }   
        }else{
            throw new DataException("Erro ao listar as ordens de serviço no banco de dados.\n");
        }
    }

    public function getFuncionarioById($id){
        // $sql = "SELECT * FROM funcionario WHERE id_funcionario = '".$id."' ;";
        // $result = mysqli_query($this->conexao, $sql);
        // if($result){
        //     return mysqli_fetch_object($result);
        // }else{
        //     throw new DataException("Erro ao selecionar o funcionário no banco de dados.\n");
        // }
    }

    public function getFuncionarioByEmail($email){
        // $sql = "SELECT * FROM funcionario WHERE email = '".$email."' ;";
        // $result = mysqli_query($this->conexao, $sql);
        // if($result){
        //     return mysqli_fetch_object($result);
        // }else{
        //     throw new DataException("Erro ao selecionar o funcionário no banco de dados.\n");
        // }
    }
    


}

?>