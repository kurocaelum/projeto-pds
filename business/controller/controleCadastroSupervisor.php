<?php 
include_once($_SERVER["DOCUMENT_ROOT"]."/business/models/Supervisor.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/data/DAO/supervisorDAO.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/business/services/serviceSupervisor.php");

class ControleCadastroSupervisor{
	public $serviceSupervisor;
	public $supervisor;

	public function __construct(){
		$this->serviceSupervisor = new ServiceSupervisor();
		$this->supervisor = new Supervisor();
		$this->verificarRequisicao();
	}

	public function verificarRequisicao(){
        if(isset($_POST['idSupervisor'])){
            if($_POST['idSupervisor'] != ""){
                $this->supervisor->setIdSupervisor($_POST['idSupervisor']);
                echo $this->alterarSupervisor();
            }else{
                if(isset($_POST['addSupervisor'])){
                    echo $this->addSupervisor();
                }
            }
        }
     
        if(isset($_POST['listaSupervisores'])){
            echo json_encode($this->getListaSupervisores(), JSON_PRETTY_PRINT);
        }
     
        if(isset($_POST['excluirSupervisor'])){
            $this->supervisor->setIdSupervisor($_POST['excluirSupervisor']);
            echo $this->excluirSupervisor();
        }   
    }

	public function setSupervisor(){
		$setor = $_POST['setor'];
        $funcionarioSupervisor = $_POST['funcionarioSupervisor'];		
        
		$this->supervisor->setSetor($setor);
        $this->supervisor->setIdFuncionario($funcionarioSupervisor);
    }

	
	public function addSupervisor(){

		$this->setSupervisor();
		
		try {
			return $this->serviceSupervisor->addSupervisor($this->getSupervisor());
		} catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
	}
	
	public function alterarSupervisor(){
    	 
        $this->setSupervisor();
        try {    
            return $this->serviceSupervisor->alterarSupervisor($this->getSupervisor());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
	}
	
	public function excluirSupervisor(){
    	try {    
            return $this->serviceSupervisor->excluirSupervisor($this->getSupervisor());
        } catch (ServiceException $e) {
            return $e->getMessage(); 
        } catch (DataException $d) {
            return $d->getMessage();
        }
	}
	
	public function getListaSupervisores(){
    	try {    
            return $this->serviceSupervisor->getListaSupervisores();
        } catch (DataException $d) {
            return $d->getMessage(); 
        }
    }
	
	public function getSupervisor(){
		return $this->supervisor;
	}    	
	
}

if(isset($_POST['idSupervisor']) || isset($_POST['listaSupervisores']) || isset($_POST['excluirSupervisor']) || isset($_POST['addSupervisor']) ){
	$controleCadastrosupervisor = new ControleCadastroSupervisor();
}

?>