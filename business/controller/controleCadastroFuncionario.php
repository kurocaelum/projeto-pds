<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceFuncionario.php");

class ControleCadastroFuncionario{
    public $serviceFuncionario;

    public function __construct(){
        $this->serviceFuncionario = new ServiceFuncionario();
        $this->verificarRequisicao();
    }

    public function verificarRequisicao(){
        if(isset($_POST['idFuncionario'])){
            if($_POST['idFuncionario'] != ""){
                echo $this->alterarFuncionario();
            }else{
                if(isset($_POST['addFuncionario'])){
                    echo $this->addFuncionario();  
                }
            }
        }
     
        if(isset($_POST['listaFuncionarios'])){
            echo json_encode($this->listarFuncionarios(), JSON_PRETTY_PRINT);
        }
     
        if(isset($_POST['excluirFuncionario'])){
            echo $this->excluirFuncionario();
        }
        
    }

    // return 1: sucesso
    // return 2: erro na validação
    // return 3: erro ao inserir
    public function addFuncionario(){    
        if($this->validarDadosFuncionario() == 1){
            if($this->serviceFuncionario->addFuncionario() == 1){
                return 1;
            }
        }else{
            return 2;
        }
        return 3;
    }

    public function alterarFuncionario(){
        $this->validarDadosFuncionario();
        $id = $_POST['idFuncionario'];
        $this->validarIdFuncionario($_POST['idFuncionario']);
        $retorno = $this->serviceFuncionario->alterarFuncionario();
        if($retorno == 1){
            return 1;
        }
        return 0;
    }

    public function excluirFuncionario(){
        $idFuncionario = $_POST['excluirFuncionario'];
        $this->validarIdFuncionario($idFuncionario); 
        if($this->serviceFuncionario->excluirFuncionario() == 1){
            return 1;
        } 
        return 0;
    }

    public function listarFuncionarios(){
        $retorno = $this->serviceFuncionario->getListaFuncionarios();
        if($retorno != 0){
            return $retorno;
        }
        return 0;
    }

    // return 0: erro na validação
    // return 1: campos validadas e setados
    public function validarDadosFuncionario(){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $supervisor_chefe = $_POST['supervisor_chefe'];
    
        if($this->validarNomeFuncionario($nome) != 1){
            return 0;
        }
        if($this->validarTelefoneFuncionario($telefone) != 1){
            return 0;
        }
        if($this->validarEmailFuncionario($email) != 1){
            return 0;
        }

        if($this->validarChefeFuncionario($supervisor_chefe) != 1){
            return 0;
        }     

        return 1;
    }

    public function validarNomeFuncionario($nome){
        if($nome == ""){
            return 0;
        }
        $this->serviceFuncionario->setNomeFuncionario($nome);
        return 1;
    }

    public function validarTelefoneFuncionario($telefone){
        if($telefone == ""){
            return 0;
        }
        $this->serviceFuncionario->setTelefoneFuncionario($telefone);
        return 1;
    }

    public function validarEmailFuncionario($email){
        if(($email == "") || (strpos($email, "@") === false)){
            return 0;
        }
        $this->serviceFuncionario->setEmailFuncionario($email);
        return 1;
    }

    public function validarChefeFuncionario($chefe){
        if(!is_numeric($chefe)){
            return 0;
        }
        $this->serviceFuncionario->setIdSupervisorChefeFuncionario($chefe);
        return 1;
    }

    public function validarIdFuncionario($id_funcionario){
        if(!is_numeric($id_funcionario)){
            return 0;
        }
        $this->serviceFuncionario->setIdFuncionario($id_funcionario);
        return 1;
    }


}


if(isset($_POST['idFuncionario']) || isset($_POST['listaFuncionarios']) || isset($_POST['excluirFuncionario']) || isset($_POST['addFuncionario']) ){
    $controleCadastrofuncionario = new ControleCadastroFuncionario();
}
    
?>