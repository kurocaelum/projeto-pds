<?php

public class TipoServico
{
	private $nome;
	private $unidadeMedida;
	private $variacaoTipoServico;

	
	public function __construct($nome, $unidadeMedida, $variacaoTipoServico)
	{
		$this->nome = $nome;
		$this->unidadeMedida = $unidadeMedida;
		$this->variacaoTipoServico = $variacaoTipoServico;
	}
}

?>