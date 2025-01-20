<?php

// Classe base Pessoa
class Pessoa {
    private $nome;
    private $idade;

    public function __construct(string $nome, int $idade)
    {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    // Métodos Getters
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }
}

// Classe Atleta herda de Pessoa
class Atleta extends Pessoa {
    private $modalidade;

    public function __construct(string $nome, int $idade, string $modalidade)
    {
        parent::__construct($nome, $idade);
        $this->modalidade = $modalidade;
    }

    // Getter para modalidade
    public function getModalidade(): string
    {
        return $this->modalidade;
    }

    // Método para exibir as informações do Atleta
    public function apresentar(): string
    {
        return "Atleta: " . $this->getNome() . ", Idade: " . $this->getIdade() . " anos, Modalidade: " . $this->getModalidade();
    }
}

// Classe Filosofo herda de Pessoa
class Filosofo extends Pessoa {
    private $nacionalidade;

    public function __construct(string $nome, int $idade, string $nacionalidade)
    {
        parent::__construct($nome, $idade);
        $this->nacionalidade = $nacionalidade;
    }

    // Getter para nacionalidade
    public function getNacionalidade(): string
    {
        return $this->nacionalidade;
    }

    // Método para exibir as informações do Filósofo
    public function apresentar(): string
    {
        return "Filósofo: " . $this->getNome() . ", Idade: " . $this->getIdade() . " anos, Nacionalidade: " . $this->getNacionalidade();
    }
}

// Criando instâncias de Atleta e Filósofo
$userAtletich = new Atleta('Maradona', 65, 'Futebol');
$userPhilosofy = new Filosofo('Zizek', 75, 'Esloveno');

// Exibindo as informações
echo $userAtletich->apresentar() . "<br>";
echo $userPhilosofy->apresentar();

?>

