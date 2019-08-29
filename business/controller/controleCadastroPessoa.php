<?php 
// controlador da parte do gerenciamento de Pessoa. Essa classe que cadastra pessoa, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre Pessoa e PessoaDAO
include("Pessoa.php");
include("../../data/pessoaDAO.php");

class ControleCadastroPessoa{
	$pessoaDAO = new PessoaDAO(); // objeto dao para salvar as pessoas e obter dados.
	$pessoasArray = []; //lista de todas as pessoas

	public function __construct(){

    }

	function getIdCadastroPessoa(){
		return 'asdsad';
    }

    function addPessoa($pessoa){
    	//envia o objeto pessoa para a funcao salvar pessoa no PessoaDAO
    	$pessoaDAO->salvarPessoa($pessoa); //criar esse método para salvar a pessoa no banco de dados
    }

    function getListaPessoas(){
    	//método para retonar o arraylist de pessoas
    	$this->$pessoasArray = $pessoaDAO->getPessoasArray();//criar ess método para retornar todas as pessoas no DAO
    	return $pessoasArray;
    }
    
	
}

if(isset($_POST['addPessoa'])){
	// pegar demais dados enviados do form html e adicionar uma pesssoa
	$nomePessoa = $_POST['nomePessoa'];
	$pessoa = new Pessoa();
	$pessoa->setNome($nomePessoa);

	$controleCadastroPessoa = new ControleCadastroPessoa();
	$controleCadastroPessoa->addPessoa($pessoa);




}


	
 ?>