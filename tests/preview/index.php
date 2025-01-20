<?php

// Criando uma instância de People
$people = new People();

// Dados para criação
$data = [
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'john.doe@example.com',
    'password' => 'supersecret', // Esse campo será ocultado
];

// Salvar no banco de dados
$people->save($data);

// Consultar e exibir o registro salvo
var_dump($people);
