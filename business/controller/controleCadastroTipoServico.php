<?php 
// controlador da parte do gerenciamento de TipoServico. Essa classe que cadastra tipoServico, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre tipoServico e tipoServicoDAO

include($_SERVER["DOCUMENT_ROOT"]."/business/models/TipoServico.php");
include($_SERVER["DOCUMENT_ROOT"]."/data/DAO/tipoServicoDAO.php");


class ControleCadastroTipoServico{
	public $tipoServicoDAO; // objeto dao para salvar as tipoServicos e obter dados.
	// public $tipoServicosArray; //lista de todas as tipoServicos
	public $tipoServico;

	public function __construct(){
		$this->tipoServicoDAO = new TipoServicoDAO();
		$this->tipoServico = new TipoServico();
		// $this->tipoServicosArray = [];
	}

	public function getTipoServico(){
		return $this->tipoServico;
	}

    public function addTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	//criar esse método para inserir a tipoServico no banco de dados
    	if($this->tipoServicoDAO->insert($tipoServico) == 1){
    		return 1;
    	}
    	return 0;
    }

    public function alterarTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	return $this->tipoServicoDAO->update($tipoServico); //criar esse método para inserir a tipoServico no banco de dados
    }

    public function excluirTipoServico($tipoServico){
    	//envia o objeto tipoServico para a funcao salvar tipoServico no tipoServicoDAO
    	return $this->tipoServicoDAO->delete($tipoServico); //criar esse método para inserir a tipoServico no banco de dados
    }


    public function getListaTipoServicos(){
    	return $this->tipoServicoDAO->getTipoServicos();
    }


    
	
}


$controleCadastroTipoServico = new ControleCadastroTipoServico();

if(isset($_POST['idTipoServico'])){
	
	$nome = $_POST['nome'];
	$unidade = $_POST['unidade'];
	$tempo = $_POST['tempo'];
	
	$controleCadastroTipoServico->getTipoServico()->setNome($nome);
	$controleCadastroTipoServico->getTipoServico()->setUnidadeMedida($unidade);
	$controleCadastroTipoServico->getTipoServico()->setTempo($tempo);

	if($_POST['idTipoServico'] != ""){
		// editar funcionário
		$id = $_POST['idTipoServico'];
		//aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
		$controleCadastroTipoServico->getTipoServico()->setIdTipoServico($_POST['idTipoServico']);
		$retorno = $controleCadastroTipoServico->alterarTipoServico( $controleCadastroTipoServico->getTipoServico() );
		//a classe update do DAO nao fo feita tmb
		echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro

	}else{
		if(isset($_POST['addTipoServico'])){
			//adicionar funcionário

			$retorno = $controleCadastroTipoServico->addTipoServico($controleCadastroTipoServico->getTipoServico());
			echo $retorno;

		}
		
	}
}

if(isset($_POST['excluirTipoServico'])){
	$idTipoServico = $_POST['excluirTipoServico'];
	$controleCadastroTipoServico->getTipoServico()->setIdTipoServico($idTipoServico); 
	$retorno = $controleCadastroTipoServico->excluirTipoServico( $controleCadastroTipoServico->getTipoServico() );
	echo $retorno;
}

if(isset($_POST['listaTipoServicos'])){
	$retorno = $controleCadastroTipoServico->getListaTipoServicos();
	echo json_encode($retorno, JSON_PRETTY_PRINT);
	
}


	
 ?>