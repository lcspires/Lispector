<?php

// Interface para padronizar métodos de pagamento
interface MetodoDePagamentoInterface {
    public function processarPagamento(float $valor): string;
    public function reembolsarPagamento(float $valor): string;
}

// Classe abstrata que implementa a interface
abstract class MetodoDePagamento implements MetodoDePagamentoInterface {
    protected string $endpoint;
    protected string $apiKey;

    public function __construct(string $endpoint, string $apiKey) {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
    }

    // Método comum para validar a chave de API
    protected function validarApiKey(): bool {
        return !empty($this->apiKey);
    }

    // Métodos abstratos específicos para implementação pelas classes filhas
    abstract public function processarPagamento(float $valor): string;
    abstract public function reembolsarPagamento(float $valor): string;
}

// Implementação para o sistema de pagamento Payloaded
class Payloaded extends MetodoDePagamento {
    public function processarPagamento(float $valor): string {
        if (!$this->validarApiKey()) {
            return "Erro: API key inválida para Payloaded.";
        }
        return "Pagamento de R$ {$valor} processado com sucesso via Payloaded no endpoint {$this->endpoint}.";
    }

    public function reembolsarPagamento(float $valor): string {
        if (!$this->validarApiKey()) {
            return "Erro: API key inválida para Payloaded.";
        }
        return "Reembolso de R$ {$valor} realizado com sucesso via Payloaded no endpoint {$this->endpoint}.";
    }
}

// Implementação para o sistema de pagamento Pagsafes
class Pagsafes extends MetodoDePagamento {
    public function processarPagamento(float $valor): string {
        if (!$this->validarApiKey()) {
            return "Erro: API key inválida para Pagsafes.";
        }
        return "Pagamento de R$ {$valor} processado com sucesso via Pagsafes no endpoint {$this->endpoint}.";
    }

    public function reembolsarPagamento(float $valor): string {
        if (!$this->validarApiKey()) {
            return "Erro: API key inválida para Pagsafes.";
        }
        return "Reembolso de R$ {$valor} realizado com sucesso via Pagsafes no endpoint {$this->endpoint}.";
    }
}

// Função para gerenciar os pagamentos usando polimorfismo
function executarPagamento(MetodoDePagamentoInterface $metodo, float $valor) {
    echo $metodo->processarPagamento($valor) . PHP_EOL;
    echo $metodo->reembolsarPagamento($valor) . PHP_EOL;
}

// Testando o sistema de pagamento Payloaded
echo "Teste com Payloaded:" . PHP_EOL;
$payloaded = new Payloaded("https://api.payloaded.com/payments", "PAYLOADED-API-123");
executarPagamento($payloaded, 150.00);

echo PHP_EOL;

// Testando o sistema de pagamento Pagsafes
echo "Teste com Pagsafes:" . PHP_EOL;
$pagsafes = new Pagsafes("https://api.pagsafes.com/payments", "PAGSAFES-API-456");
executarPagamento($pagsafes, 250.00);

echo PHP_EOL;

// Testando com chave de API inválida
echo "Teste com API Key inválida:" . PHP_EOL;
$invalid = new Payloaded("https://api.payloaded.com/payments", "");
executarPagamento($invalid, 100.00);

