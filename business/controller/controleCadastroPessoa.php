<?php 
include("Pessoa.php");

class ControleCadastroPessoa{
	public $pessoa;

	public function __construct($pessoa){
        $this->pessoa = $pessoa;
    }

	function getIdCadastroPessoa(){
		return 'asdsad';
    	// return $this->idFuncionario;
    }

    // fazer get e set pessoa
	
}

if(isset($_POST['addPessoa'])){
	$controleCadastroPessoa = new ControleCadastroPessoa();
	// pegar demais dados enviados do form html
}


	
 ?>