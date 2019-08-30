<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

include($_SERVER["DOCUMENT_ROOT"]."/business/models/Funcionario.php");
include($_SERVER["DOCUMENT_ROOT"]."/data/DAO/funcionarioDAO.php");


class ControleCadastroFuncionario{
	public $funcionarioDAO; // objeto dao para salvar as funcionarios e obter dados.
	// public $funcionariosArray; //lista de todas as funcionarios

	public function __construct(){
		$this->funcionarioDAO = new FuncionarioDAO();
		// $this->funcionariosArray = [];
	}


	public function getIdCadastroFuncionario(){
		return 'asdsad';
    }

    public function addFuncionario($funcionario){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	//criar esse método para inserir a funcionario no banco de dados
    	if($this->funcionarioDAO->insert($funcionario) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarFuncionario($funcionarioNovo){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	$this->funcionarioDAO->update($funcionarioNovo); //criar esse método para inserir a funcionario no banco de dados
    }

    public function excluirFuncionario($funcionario){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	return $this->funcionarioDAO->delete($funcionario); //criar esse método para inserir a funcionario no banco de dados
    }


    public function getListaFuncionarios(){
    	return $this->funcionarioDAO->getFuncionarios();
    }


    
	
}


$controleCadastrofuncionario = new ControleCadastrofuncionario();
$funcionario = new Funcionario();

if(isset($_POST['idFuncionario'])){
	
	$nome = $_POST['nome'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];

	if($_POST['idFuncionario'] != ""){
		// editar funcionário
		$id = $_POST['idFuncionario'];
		//aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
		$retorno = $controleCadastrofuncionario->alterarFuncionario($funcionario);
		//a classe update do DAO nao fo feita tmb
		echo 1; // 1 é pra quando editou corretamente. 0 é quando deu erro

	}else{
		if(isset($_POST['addFuncionario'])){
			//adicionar funcionário
			$funcionario->setNome($nome); // falta email e telefone
			$retorno = $controleCadastrofuncionario->addFuncionario($funcionario);
			echo $retorno;

		}
		
	}
}

if(isset($_POST['excluirFuncionario'])){
	$idFuncionario = $_POST['excluirFuncionario'];
	$funcionario = new Funcionario();
	$funcionario->setIdFuncionario($idFuncionario); 
	$retorno = $controleCadastrofuncionario->excluirFuncionario($funcionario);
	echo $retorno;
}

if(isset($_POST['listaFuncionarios'])){
	$idFuncionario = $_POST['excluirFuncionario'];
	$funcionario = new Funcionario();
	$funcionario->setIdFuncionario($idFuncionario); 
	$retorno = $controleCadastrofuncionario->getListaFuncionarios();
	echo json_encode($retorno, JSON_PRETTY_PRINT);
	
}


	
 ?>