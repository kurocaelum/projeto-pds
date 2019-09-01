<?php 
// controlador da parte do gerenciamento de Funcionario. Essa classe que cadastra funcionario, recebe os dados do html, salva no banco  e tmb retorna os dados salvos
// ela que faz ligacao entre funcionario e funcionarioDAO

include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Supervisor.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/supervisorDAO.php");


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
    	return $this->supervisorDAO->update($supervisorNovo); //criar esse método para inserir a funcionario no banco de dados
    }

    public function excluirSupervisor($supervisor){
    	//envia o objeto funcionario para a funcao salvar funcionario no funcionarioDAO
    	return $this->supervisorDAO->delete($supervisor); //criar esse método para inserir a funcionario no banco de dados
    }


    public function getListaSupervisores(){
    	return $this->supervisorDAO->getSupervisores();
    }

    /* Remover
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
    */
    
	
}



	
	

 ?>