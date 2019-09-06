<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

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
                $this->alterarFuncionario();
            }else{
                if(isset($_POST['addFuncionario'])){
                    $this->addFuncionario();  
                }
            }
        }
        if(isset($_POST['listaFuncionarios'])){
            $this->listarFuncionarios();
        }
        if(isset($_POST['excluirFuncionario'])){
            $this->excluirFuncionario();
        }
        
    }

    public function addFuncionario(){    
        $this->validarDadosFuncionario();
    	echo $this->serviceFuncionario->addFuncionario();
    }

    public function alterarFuncionario(){
        $this->validarDadosFuncionario();
        $id = $_POST['idFuncionario'];
        $this->validarIdFuncionario($_POST['idFuncionario']);
        $retorno = $this->serviceFuncionario->alterarFuncionario();
        echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro
    }

    public function excluirFuncionario(){
        $idFuncionario = $_POST['excluirFuncionario'];
        $this->validarIdFuncionario($idFuncionario); 
        echo $this->serviceFuncionario->excluirFuncionario();
    }

    public function listarFuncionarios(){
        $retorno = $this->serviceFuncionario->getListaFuncionarios();
        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }

    public function validarDadosFuncionario(){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $supervisor_chefe = $_POST['supervisor_chefe'];
    
        $this->validarNomeFuncionario($nome); // falta email e telefone
        $this->validarTelefoneFuncionario($telefone); // falta email e telefone
        $this->validarEmailFuncionario($email);
        $this->validarChefeFuncionario($supervisor_chefe);     
    }

    public function validarNomeFuncionario($nome){
         $this->serviceFuncionario->getFuncionario()->setNome($nome);
    }
    public function validarTelefoneFuncionario($telefone){
         $this->serviceFuncionario->getFuncionario()->setTelefone($telefone);
    }
    public function validarEmailFuncionario($email){
         $this->serviceFuncionario->getFuncionario()->setEmail($email);
    }
    public function validarChefeFuncionario($chefe){
         $this->serviceFuncionario->getFuncionario()->setIdSupervisorChefe($chefe);
    }
    public function validarIdFuncionario($id_funcionario){
         $this->serviceFuncionario->getFuncionario()->setIdFuncionario($id_funcionario);
    }


}


if(isset($_POST['idFuncionario']) || isset($_POST['listaFuncionarios']) || isset($_POST['excluirFuncionario']) || isset($_POST['addFuncionarios']) ){
    $controleCadastrofuncionario = new ControleCadastroFuncionario();
}
	
?>