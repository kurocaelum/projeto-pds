<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

include($_SERVER["DOCUMENT_ROOT"]."/business/models/Supervisor.php");
include($_SERVER["DOCUMENT_ROOT"]."/data/DAO/supervisorDAO.php");


class ControleCadastroSupervisor{
	public $supervisorDAO; // objeto dao para salvar as funcionarios e obter dados.
	// public $funcionariosArray; //lista de todas as funcionarios

	public function __construct(){
		$this->supervisorDAO = new SupervisorDAO();
		// $this->funcionariosArray = [];
	}

	public function addSupervisor($supervisor){
    	if($this->supervisorDAO->insert($supervisor) == 1){
    		return 1;
    	}
    	return 0;
    }

    // public function alterarFuncionario($funcionarioNovo){
    // 	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    // 	$this->funcionarioDAO->update($funcionarioNovo); //criar esse método para inserir a funcionario no banco de dados
    // }

    // public function excluirFuncionario($funcionario){
    // 	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    // 	return $this->funcionarioDAO->delete($funcionario); //criar esse método para inserir a funcionario no banco de dados
    // }


    // public function getListaFuncionarios(){
    // 	return $this->funcionarioDAO->getFuncionarios();
    // }
    
	
}

$controleCadastroSupervisor = new ControleCadastroSupervisor();
$supervisor = new Supervisor();

if(isset($_POST['addSupervisor'])){
	//adicionar funcionário
	$setor = $_POST['setor'];
	$funcionarioSupervisor = $_POST['funcionarioSupervisor'];
	$funcionarioAdministrados = $_POST['funcionarioAdministrados'];

	$supervisor->setSetor($setor); // falta email e telefone
	$supervisor->setIdFuncionario($funcionarioSupervisor);
	$retorno = $controleCadastroSupervisor->addSupervisor($supervisor);
	echo $retorno;

}


	
 ?>