<?php

// Interface para padronizar o contrato
interface AutenticacaoInterface {
    public function autenticar(string $token): string; // Método para autenticar o usuário
    public function obterUsuario(): array; // Método para obter informações do usuário autenticado
}

// Classe abstrata para lógica compartilhada
abstract class AutenticacaoBase implements AutenticacaoInterface {
    protected string $endpoint;
    protected string $apiKey;

    public function __construct(string $endpoint, string $apiKey) {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
    }

    // Método comum para validar token (exemplo genérico)
    protected function validarToken(string $token): bool {
        return strlen($token) > 10; // Apenas um exemplo simples de validação
    }
}

// Classe para autenticação via Google
class GoogleAuth extends AutenticacaoBase {
    public function autenticar(string $token): string {
        if (!$this->validarToken($token)) {
            return "Token inválido para Google.";
        }
        return "Autenticação realizada com sucesso via Google.";
    }

    public function obterUsuario(): array {
        return [
            'nome' => 'Usuário Google',
            'email' => 'usuario@google.com'
        ];
    }
}

// Classe para autenticação via GitHub
class GitHubAuth extends AutenticacaoBase {
    public function autenticar(string $token): string {
        if (!$this->validarToken($token)) {
            return "Token inválido para GitHub.";
        }
        return "Autenticação realizada com sucesso via GitHub.";
    }

    public function obterUsuario(): array {
        return [
            'nome' => 'Usuário GitHub',
            'email' => 'usuario@github.com'
        ];
    }
}

// Classe para autenticação via Twitter
class TwitterAuth extends AutenticacaoBase {
    public function autenticar(string $token): string {
        if (!$this->validarToken($token)) {
            return "Token inválido para Twitter.";
        }
        return "Autenticação realizada com sucesso via Twitter.";
    }

    public function obterUsuario(): array {
        return [
            'nome' => 'Usuário Twitter',
            'email' => 'usuario@twitter.com'
        ];
    }
}

// Testando a autenticação com diferentes serviços
function testarAutenticacao(AutenticacaoInterface $autenticador, string $token) {
    echo $autenticador->autenticar($token) . PHP_EOL;
    print_r($autenticador->obterUsuario());
    echo PHP_EOL;
}

// Testando com Google
echo "Teste com Google:" . PHP_EOL;
$googleAuth = new GoogleAuth("https://api.google.com/auth", "GOOGLE-API-KEY");
testarAutenticacao($googleAuth, "token-google-valido");

echo PHP_EOL;

// Testando com GitHub
echo "Teste com GitHub:" . PHP_EOL;
$githubAuth = new GitHubAuth("https://api.github.com/auth", "GITHUB-API-KEY");
testarAutenticacao($githubAuth, "token-github-valido");

echo PHP_EOL;

// Testando com Twitter
echo "Teste com Twitter:" . PHP_EOL;
$twitterAuth = new TwitterAuth("https://api.twitter.com/auth", "TWITTER-API-KEY");
testarAutenticacao($twitterAuth, "token-twitter-valido");

