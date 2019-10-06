<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");

class FuncionarioDAO{
    public $arrayFuncionarios;
    public $conexao;

    public function __construct(){
        $this->arrayFuncionarios = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($funcionario){
        $sql = "INSERT INTO funcionario (nome, telefone, email, id_supervisor_chefe) VALUES ('".$funcionario->getNome()."', '".$funcionario->getTelefone()."', '".$funcionario->getEmail()."', '".$funcionario->getIdSupervisorChefe()."') ";
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao inserir o funcionário no banco de dados.\n");
        }
    }
     
    public function update($funcionario){
         $sql = "UPDATE funcionario SET id_supervisor_chefe = '".$funcionario->getIdSupervisorChefe()."', nome = '".$funcionario->getNome()."', telefone = '".$funcionario->getTelefone()."', email = '".$funcionario->getEmail()."' WHERE  funcionario.id_funcionario = '".$funcionario->getIdFuncionario()."'";
        // echo $sql;
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao atualizar o funcionário no banco de dados.\n");
        }
    }
     
    public function delete($funcionario){
        if($funcionario->getIdFuncionario() != ""){
            $sql = "DELETE FROM funcionario WHERE id_funcionario=".$funcionario->getIdFuncionario();
            if(!mysqli_query($this->conexao, $sql)){
                throw new DataException("Erro ao remover o funcionário do banco de dados.\n");
            }
        }
    }

    //retorna array de objetos de funcionarios
    public function getFuncionarios(){
        $sql = "SELECT * FROM funcionario";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_object($result)) {
                    $funcionario = new Funcionario();
                    $funcionario->setNome($row->nome);
                    $funcionario->setEmail($row->email);
                    $funcionario->setTelefone($row->telefone);
                    $funcionario->setIdFuncionario($row->id_funcionario);
                    $funcionario->setIdSupervisorChefe($row->id_supervisor_chefe);

                    $this->arrayFuncionarios[count($this->arrayFuncionarios) + 1] = $funcionario;
                }
                return $this->arrayFuncionarios;
            }   
        }else{
            throw new DataException("Erro ao listar os funcionários no banco de dados.\n");
        }
    }

    public function getFuncionarioById($id){
        $sql = "SELECT * FROM funcionario WHERE id_funcionario = '".$id."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            $row = mysqli_fetch_object($result);
            $funcionario = new Funcionario();
            $funcionario->setNome($row->nome);
            $funcionario->setEmail($row->email);
            $funcionario->setTelefone($row->telefone);
            $funcionario->setIdFuncionario($row->id_funcionario);
            $funcionario->setIdSupervisorChefe($row->id_supervisor_chefe);
            return $funcionario;
        }else{
            throw new DataException("Erro ao selecionar o funcionário no banco de dados.\n");
        }
    }

    public function getFuncionarioByEmail($email){
        $sql = "SELECT * FROM funcionario WHERE email = '".$email."' ;";
        $result = mysqli_query($this->conexao, $sql);

        if($result){

            if($result->num_rows > 0){
                $row = mysqli_fetch_object($result);
                $funcionario = new Funcionario();
                $funcionario->setNome($row->nome);
                $funcionario->setEmail($row->email);
                $funcionario->setTelefone($row->telefone);
                $funcionario->setIdFuncionario($row->id_funcionario);
                $funcionario->setIdSupervisorChefe($row->id_supervisor_chefe);
                return $funcionario;
            }else{
                return 0;
            }

        }else{
            throw new DataException("Erro ao selecionar o funcionário no banco de dados.\n");
        }
    }
    


}

?>