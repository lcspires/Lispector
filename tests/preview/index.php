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
		if ($this->cpf != null){
			return $this->cpf;
		} else {
			return 'não cadastrado';
		}
	}
}

class Pessoa extends Caracteristicas {
	private $time;

	public function __construct(string $nome, int $idade, string $time, string $cpf = null)
	{
		parent::__construct($nome, $idade, $cpf);
		$this->time = $time;
	}

	public function getCPF(): ?string
	{
		return parent::getCPF();
	}
}

$userTest = new Pessoa('Lucas', 29, 'Palmeiras');
echo $userTest->getCPF();
var_dump($userTest);
