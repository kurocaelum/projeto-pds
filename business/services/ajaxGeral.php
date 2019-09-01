<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroTipoServico.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroFuncionario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroSupervisor.php");

class ControleAjax{
	
	public $controleCadastroSupervisor;
	public $controleCadastroServico;
	public $controleCadastrofuncionario;
	public $controleCadastroTipoServico;

	public function __construct(){
		$this->controleCadastroSupervisor = new ControleCadastroSupervisor();
		$this->controleCadastroServico = new ControleCadastroServico();
		$this->controleCadastrofuncionario = new ControleCadastrofuncionario();
		$this->controleCadastroTipoServico = new ControleCadastroTipoServico();
	}

	public function ajaxServicos(){
		
		if(isset($_POST['idServico'])){
		    
		    $nome = $_POST['nome'];
		    $local = $_POST['local'];
		    $dataCadastro = $_POST['data'];
		    $status = $_POST['status'];
		    $tipoServico = $_POST['tipoServico'];
		    $quantidade = $_POST['quantidade'];

		    
		    $this->controleCadastroServico->getServico()->setNome($nome);
		    $this->controleCadastroServico->getServico()->setLocal($local);
		    $this->controleCadastroServico->getServico()->setDataCadastro($data);
		    $this->controleCadastroServico->getServico()->setStatus($status);
		    $this->controleCadastroServico->getServico()->setQuantidade($quantidade);
		    $this->controleCadastroServico->getServico()->setTipoServico($tipoServico);


		    if($_POST['idServico'] != ""){
		        // editar funcionário
		        $id = $_POST['idServico'];
		        //aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
		        $this->controleCadastroServico->getServico()->setIdServico($_POST['idServico']);
		        $retorno = $this->controleCadastroServico->alterarServico($this->controleCadastroServico->getServico());
		        //a classe update do DAO nao fo feita tmb
		        echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro

		    }else{
		        if(isset($_POST['addServico'])){
		            //adicionar funcionário

		            $retorno = $this->controleCadastroServico->addServico($this->controleCadastroServico->getServico());
		            echo $retorno;

		        }
		        
		    }

			
		}
		if(isset($_POST['excluirServico'])){
		    $idServico = $_POST['excluirServico'];
		    $this->controleCadastroServico->getServico()->setIdServico($idServico); 
		    $retorno = $this->controleCadastroServico->excluirServico($this->controleCadastroServico->getServico());
		    echo $retorno;
		}

		if(isset($_POST['listaServicos'])){
		    $retorno = $this->controleCadastroServico->getListaServicos();
		    echo json_encode($retorno, JSON_PRETTY_PRINT); // verificar se aqui está certo
		    
		}
	}

	public function ajaxFuncionarios(){

		if(isset($_POST['idFuncionario'])){
		
			$nome = $_POST['nome'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$supervisor_chefe = $_POST['supervisor_chefe'];
			
			$this->controleCadastrofuncionario->getFuncionario()->setNome($nome); // falta email e telefone
			$this->controleCadastrofuncionario->getFuncionario()->setTelefone($telefone); // falta email e telefone
			$this->controleCadastrofuncionario->getFuncionario()->setEmail($email);
			$this->controleCadastrofuncionario->getFuncionario()->setIdSupervisorChefe($supervisor_chefe); 

			if($_POST['idFuncionario'] != ""){
					// editar funcionário
					$id = $_POST['idFuncionario'];
					//aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
					$this->controleCadastrofuncionario->getFuncionario()->setIdFuncionario($_POST['idFuncionario']);
					$retorno = $this->controleCadastrofuncionario->alterarFuncionario( $this->controleCadastrofuncionario->getFuncionario() );
					//a classe update do DAO nao fo feita tmb
					echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro
			}else{
				if(isset($_POST['addFuncionario'])){
					//adicionar funcionário

					$retorno = $this->controleCadastrofuncionario->addFuncionario($this->controleCadastrofuncionario->getFuncionario());
					echo $retorno;

				}
				
			}
		}

		if(isset($_POST['excluirFuncionario'])){
			$idFuncionario = $_POST['excluirFuncionario'];
			$this->controleCadastrofuncionario->getFuncionario()->setIdFuncionario($idFuncionario); 
			$retorno = $this->controleCadastrofuncionario->excluirFuncionario( $this->controleCadastrofuncionario->getFuncionario() );
			echo $retorno;
		}

		if(isset($_POST['listaFuncionarios'])){
			$retorno = $this->controleCadastrofuncionario->getListaFuncionarios();
			echo json_encode($retorno, JSON_PRETTY_PRINT);
			
		}
	}

	public function ajaxSupervisor(){


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
				$this->controleCadastroSupervisor->getSupervisor()->setIdSupervisor($idSupervisor);
				$this->controleCadastroSupervisor->getSupervisor()->setNome($nome);
				$this->controleCadastroSupervisor->getSupervisor()->setSetor($setor);
				$this->controleCadastroSupervisor->getSupervisor()->setIdFuncionario($funcionarioSupervisor);

				// $this->controleCadastroSupervisor->setFuncionariosAdministrados( explode(",", $funcionarioAdministrados) );		

				$retorno = $this->controleCadastroSupervisor->alterarSupervisor( $this->controleCadastroSupervisor->getSupervisor() );
				//a classe update do DAO nao fo feita tmb
				echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro

			}else{
				if(isset($_POST['addSupervisor'])){
					//adicionar funcionário
					$this->controleCadastroSupervisor->getSupervisor()->setNome($nome);
					$this->controleCadastroSupervisor->getSupervisor()->setSetor($setor);
					$this->controleCadastroSupervisor->getSupervisor()->setIdFuncionario($funcionarioSupervisor);

					//$this->controleCadastroSupervisor->setFuncionariosAdministrados( explode(",", $funcionarioAdministrados) );		

					$retorno = $this->controleCadastroSupervisor->addSupervisor();
					echo $retorno;
				}
			}
		}

		if(isset($_POST['excluirSupervisor'])){
			$idSupervisor = $_POST['excluirSupervisor'];
			$this->controleCadastroSupervisor->getSupervisor()->setIdSupervisor($idSupervisor); 
			$retorno = $this->controleCadastroSupervisor->excluirSupervisor( $this->controleCadastroSupervisor->getSupervisor() );
			echo $retorno;
		}

		if(isset($_POST['listaSupervisores'])){
			$retorno = $this->controleCadastroSupervisor->getListaSupervisores();
			echo json_encode($retorno, JSON_PRETTY_PRINT);
			
		}
	}


	function ajaxTipoServico(){

		if(isset($_POST['idTipoServico'])){
			
			$nome = $_POST['nome'];
			$unidade = $_POST['unidade'];
			$tempo = $_POST['tempo'];
			
			$this->controleCadastroTipoServico->getTipoServico()->setNome($nome);
			$this->controleCadastroTipoServico->getTipoServico()->setUnidadeMedida($unidade);
			$this->controleCadastroTipoServico->getTipoServico()->setTempo($tempo);

			if($_POST['idTipoServico'] != ""){
				// editar funcionário
				$id = $_POST['idTipoServico'];
				//aqui deve setar parametros do funcionário e enviar ele para alterarFUncionario
				$this->controleCadastroTipoServico->getTipoServico()->setIdTipoServico($_POST['idTipoServico']);
				$retorno = $this->controleCadastroTipoServico->alterarTipoServico( $this->controleCadastroTipoServico->getTipoServico() );
				//a classe update do DAO nao fo feita tmb
				echo $retorno; // 1 é pra quando editou corretamente. 0 é quando deu erro

			}else{
				if(isset($_POST['addTipoServico'])){
					//adicionar funcionário

					$retorno = $this->controleCadastroTipoServico->addTipoServico($this->controleCadastroTipoServico->getTipoServico());
					echo $retorno;

				}
				
			}
		}

		if(isset($_POST['excluirTipoServico'])){
			$idTipoServico = $_POST['excluirTipoServico'];
			$this->controleCadastroTipoServico->getTipoServico()->setIdTipoServico($idTipoServico); 
			$retorno = $this->controleCadastroTipoServico->excluirTipoServico( $this->controleCadastroTipoServico->getTipoServico() );
			echo $retorno;
		}

		if(isset($_POST['listaTipoServicos'])){
			$retorno = $this->controleCadastroTipoServico->getListaTipoServicos();
			echo json_encode($retorno, JSON_PRETTY_PRINT);
			
		}
	}



}



if(isset($_POST['idServico']) || isset($_POST['listaServicos']) || isset($_POST['excluirServico']) || isset($_POST['addServico']) ){
	$controleAjax = new ControleAjax();
	$controleAjax->ajaxServicos();
}


if(isset($_POST['idFuncionario']) || isset($_POST['listaFuncionarios']) || isset($_POST['excluirFuncionario']) || isset($_POST['addFuncionarios']) ){
	$controleAjax = new ControleAjax();
	$controleAjax->ajaxFuncionarios();
}

if(isset($_POST['idSupervisor']) || isset($_POST['listaSupervisores']) || isset($_POST['excluirSupervisor']) || isset($_POST['addSupervisor']) ){
	$controleAjax = new ControleAjax();
	$controleAjax->ajaxSupervisor();
}

if(isset($_POST['idTipoServico']) || isset($_POST['listaTipoServicos']) || isset($_POST['excluirTipoServico']) || isset($_POST['addTipoServico']) ){
	$controleAjax = new ControleAjax();
	$controleAjax->ajaxTipoServico();
}



?>