<?php

class Caracteristicas {
	protected $nome;
	private $idade;
	private $cpf;

	public function __construct(string $nome, int $idade, string $cpf = null)
	{
		$this->nome = $nome;
		$this->idade = $idade;
		$this->cpf = $cpf;
	}

	public function setCPF(string $cpf)
	{
		$this->cpf = $cpf;
	}

	protected function getCPF(): ?string
	{
		return $this->cpf;
	}
}

class Pessoa extends Caracteristicas {
	private $time;

	public function __construct(string $nome, int $idade, string $cpf = null, string $time = null)
	{
		parent::__construct($nome, $idade, $cpf);
		$this->time = $time;
	}

	public function getCPF(): ?string
	{
		return parent::getCPF();
	}
}

$userTest = new Pessoa('Jorge', 21, '031.946.215-96', 'Vitória');
echo $userTest->getCPF();
