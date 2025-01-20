<?php

class People extends Model
{
    // Definir o nome da tabela
    public $table = "peoples";

    // Campos que podem ser preenchidos via create ou update
    public $fillables = [
        'name', 'age', 'email'
    ];

    // Campos que serão ocultados ao retornar os dados
    protected $hidden = ['password'];

    // Definir campos obrigatórios para validação
    protected function requiredFields()
    {
        return ['name', 'email']; // Agora 'name' e 'email' são obrigatórios
    }

    // Caso seja necessário personalizar a validação (exemplo de e-mail)
    protected function validate(array $data)
    {
        // Validar e-mail
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return 'E-mail inválido';
        }
        
        return parent::validate($data); // Chama o método de validação da classe pai (Model)
    }
}

