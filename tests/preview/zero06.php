<?php

// tal Pessoa é um Atleta

class Pessoa {
	private $nome;
	private $idade;
	protected $hobby;
	private $email;

	public function __construct(string $nome, int $idade)
	{
		$this->nome = $nome;
		$this->idade = $idade;
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

}

class Atleta extends Pessoa {
	private $modalidade;

	public function __construct($nome, $idade, $modalidade, $hobby)
	{
        	parent::__construct($nome, $idade);
		$this->modalidade = $modalidade;
		$this->hobby = $hobby;
    	}
}

class Filosofo extends Pessoa {
	private $nacionalidade;

	public function __construct($nome, $idade, $nacionalidade)
	{
		parent::__construct($nome, $idade);
		$this->nacionalidade = $nacionalidade;
	}
}

$userAtletich = new Atleta('Maradona', 65, 'Futebol', 'coke');
$userPhilosofy = new Filosofo('Zizek', 75, 'Esloveno', 'zizek@bol.com');
$userPhilosofy->setEmail('zizek@bol.com');
var_dump($userAtletich, $userPhilosofy);
