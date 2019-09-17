<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/exception/dataException.php");

class SupervisorDAO{
    public $arraySupervisores;
    public $conexao;

    public function __construct(){
        $this->arraySupervisores = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($supervisor){
        $sql = "INSERT INTO supervisor (id_funcionario, setor, id_supervisor) VALUES ('".$supervisor->getIdFuncionario()."', '".$supervisor->getSetor()."', '".$supervisor->getIdSupervisor()."' ) ";
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao inserir o supervisor no banco de dados.\n");
        }
        return true;
    }
     
    public function update($supervisor){
        $sql = "UPDATE supervisor SET setor = '".$supervisor->getSetor()."', id_funcionario = '".$supervisor->getIdFuncionario()."' WHERE supervisor.id_supervisor = '".$supervisor->getIdSupervisor()."'";
        if(!mysqli_query($this->conexao, $sql)){
            throw new DataException("Erro ao atualizar o supervisor no banco de dados.\n");
        }
        return true;
    }
     
    public function delete($supervisor){
        if($supervisor->getIdSupervisor() != ""){
            $sql = "DELETE FROM supervisor WHERE id_supervisor = ".$supervisor->getIdSupervisor();
            if(!mysqli_query($this->conexao, $sql)){
                throw new DataException("Erro ao remover o supervisor do banco de dados.\n");
            }
        }
        return true;
    }

    //retorna array de objetos de funcionarios
    public function getSupervisores(){
        $sql = "SELECT * FROM supervisor INNER JOIN funcionario as f ON supervisor.id_funcionario = f.id_funcionario ";

        $result = mysqli_query($this->conexao, $sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arraySupervisores[count($this->arraySupervisores) + 1] = $row;
                }
                return $this->arraySupervisores;
            } else {
                throw new DataException("Erro ao listar os supervisores do banco de dados.\n");
            }
    }

    public function getSupervisorById($idSupervisor){
        $sql = "SELECT * FROM supervisor WHERE id_supervisor = '".$idSupervisor."' ;";
        $result = mysqli_query($this->conexao, $sql);
        if($result){
            return mysqli_fetch_object($result);
        }else{
            throw new DataException("Erro ao selecionar o supervisor no banco de dados.\n");
        }
    }

}

?>