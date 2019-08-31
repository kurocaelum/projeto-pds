<?php
include($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");

class SupervisorDAO{
    public $arraySupervisores;
    public $conexao;

    public function __construct(){
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($supervisor){
        $sql = "INSERT INTO supervisor (id_funcionario, setor) VALUES ('".$supervisor->getIdFuncionario()."', '".$supervisor->getSetor()."' ) ";
      
        
        $id_retorno = mysqli_query($this->conexao, $sql);
        $id_supervisor = mysqli_insert_id($this->conexao);

        if($id_retorno){

            foreach ($supervisor->getFuncionariosAdministrados() as $funcionario) {
                $this->insertRelacaoAdministrado($funcionario->getIdFuncionario(), $id_supervisor);
            }

            return 1;
        }
        return 0;
    }
    
    public function insertRelacaoAdministrado($idAdministrado, $idSupervisor){
        $sql = "INSERT INTO administracao (id_funcionario, id_supervisor) VALUES ('".$idAdministrado."', '".$idSupervisor."' ) ";     
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
     
    public function update($funcionario){
        
    }
     
    public function delete($supervisor){
        if($supervisor->getIdSupervisor() != ""){
            $sql = "DELETE FROM supervisor WHERE id_supervisor = ".$supervisor->getIdSupervisor();
            if(mysqli_query($this->conexao, $sql)){
                return 1;
            }
        }
        return 0;
    }

    //retorna array de objetos de funcionarios
    public function getSupervisores(){
        $sql = "SELECT * FROM supervisor INNER JOIN funcionario ON supervisor.id_funcionario = funcionario.id_funcionario ";

        $result = mysqli_query($this->conexao, $sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arraySupervisores[count($this->arraySupervisores) + 1] = $row;
                }
                return $this->arraySupervisores;
            }   
        return 0;
    }

}

?>