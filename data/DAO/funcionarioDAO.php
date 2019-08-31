<?php
include($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");

class FuncionarioDAO{
    public $arrayFuncionarios;
    public $conexao;

    public function __construct(){
        $this->arrayFuncionarios = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($funcionario){
        $sql = "INSERT INTO funcionario (nome, telefone, email) VALUES ('".$funcionario->getNome()."', '".$funcionario->getTelefone()."', '".$funcionario->getEmail()."') ";
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function update($funcionario){
         $sql = "UPDATE funcionario SET nome = '".$funcionario->getNome()."', telefone = '".$funcionario->getTelefone()."', email = '".$funcionario->getEmail()."' WHERE  funcionario.id_funcionario = '".$funcionario->getIdFuncionario()."'";
        // echo $sql;
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function delete($funcionario){
        if($funcionario->getIdFuncionario() != ""){
            $sql = "DELETE FROM funcionario WHERE id_funcionario=".$funcionario->getIdFuncionario();
            if(mysqli_query($this->conexao, $sql)){
                return 1;
            }
        }
        return 0;
    }

    //retorna array de objetos de funcionarios
    public function getFuncionarios(){
        $sql = "SELECT * FROM funcionario";
        $result = mysqli_query($this->conexao, $sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arrayFuncionarios[count($this->arrayFuncionarios) + 1] = $row;
                }
                return $this->arrayFuncionarios;
            }   
        return 0;
    }

}

?>