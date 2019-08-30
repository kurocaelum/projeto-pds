<?php

class OrdemServico
{
	private $idOs;
	private $servicos;
	private $funcionario;
	private $tempoExecucao;
	
	public function __construct($idOs, $servicos, $funcionario, $tempoExecucao)
	{
		$this->idOs = $idOs;
		$this->servicos = $servicos;
		$this->funcionario = $funcionario;
		$this->tempoExecucao = $tempoExecucao;
	}
}

?>