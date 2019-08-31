<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

include($_SERVER["DOCUMENT_ROOT"]."/business/models/Supervisor.php");
include($_SERVER["DOCUMENT_ROOT"]."/data/DAO/supervisorDAO.php");


class ControleCadastroSupervisor{
	public $supervisorDAO; // objeto dao para salvar as funcionarios e obter dados.
	public $supervisor;

	// public $funcionariosArray; //lista de todas as funcionarios

	public function __construct(){
		$this->supervisorDAO = new SupervisorDAO();
		$this->supervisor = new Supervisor();
	}

	public function getSupervisor(){
		return $this->supervisor;
	}

	public function addSupervisor(){
    	if($this->supervisorDAO->insert($this->supervisor) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarSupervisor($supervisorNovo){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	$this->supervisorDAO->update($supervisorNovo); //criar esse método para inserir a funcionario no banco de dados
    }

    public function excluirSupervisor($supervisor){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	return $this->supervisorDAO->delete($supervisor); //criar esse método para inserir a funcionario no banco de dados
    }


    public function getListaSupervisores(){
    	return $this->supervisorDAO->getSupervisores();
    }

    function setFuncionariosAdministrados($idsFuncionarios){
    	$listFuncionarios = [];
    	for ($i=0; $i < count($idsFuncionarios); $i++) { 
    		if($idsFuncionarios != ""){
	            $funcionarioAdm = new Funcionario();
	            $funcionarioAdm->setIdFuncionario($idsFuncionarios[$i]);
	            $listFuncionarios[count($listFuncionarios)+1] = $funcionarioAdm;
	            // echo $idsFuncionarios[$i]."==";
    		}
        }
        $this->supervisor->setFuncionariosAdministrados( $listFuncionarios );

    }
    
	
}


$controleCadastroSupervisor = new ControleCadastroSupervisor();

if(isset($_POST['idSupervisor'])){
	
	$nome = $_POST['nome'];
	$telefone = $_POST['telefone'];
	$idSupervisor = $_POST['idSupervisor'];
	$email = $_POST['email'];
	$setor = $_POST['setor'];
	$funcionarioSupervisor = $_POST['funcionarioSupervisor'];
	$funcionarioAdministrados = $_POST['idAdministrados'];


	if($_POST['idSupervisor'] != ""){
		// editar funcionário
		//aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
		$controleCadastroSupervisor->getSupervisor()->setIdSupervisor($idSupervisor);
		$controleCadastroSupervisor->getSupervisor()->setNome($nome);
		$controleCadastroSupervisor->getSupervisor()->setSetor($setor);
		$controleCadastroSupervisor->getSupervisor()->setIdFuncionario($funcionarioSupervisor);

		// $controleCadastroSupervisor->setFuncionariosAdministrados( explode(",", $funcionarioAdministrados) );		

		$retorno = $controleCadastroSupervisor->alterarSupervisor( $controleCadastroSupervisor->getSupervisor() );
		//a classe update do DAO nao fo feita tmb
		echo 1; // 1 é pra quando editou corretamente. 0 é quando deu erro

	}else{
		if(isset($_POST['addSupervisor'])){
			//adicionar funcionário
			$controleCadastroSupervisor->getSupervisor()->setIdSupervisor($idSupervisor);
			$controleCadastroSupervisor->getSupervisor()->setNome($nome);
			$controleCadastroSupervisor->getSupervisor()->setSetor($setor);
			$controleCadastroSupervisor->getSupervisor()->setIdFuncionario($funcionarioSupervisor);

			$controleCadastroSupervisor->setFuncionariosAdministrados( explode(",", $funcionarioAdministrados) );		

			$retorno = $controleCadastroSupervisor->addSupervisor();
			echo $retorno;

		}
		
	}
}

if(isset($_POST['excluirSupervisor'])){
	$idSupervisor = $_POST['excluirSupervisor'];
	$controleCadastroSupervisor->getSupervisor()->setIdSupervisor($idSupervisor); 
	$retorno = $controleCadastroSupervisor->excluirSupervisor( $controleCadastroSupervisor->getSupervisor() );
	echo $retorno;
}

if(isset($_POST['listaSupervisores'])){
	$retorno = $controleCadastroSupervisor->getListaSupervisores();
	echo json_encode($retorno, JSON_PRETTY_PRINT);
	
}


	
	

 ?>