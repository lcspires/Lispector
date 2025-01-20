<?php

// configurações genéricas para estabelecer conexões com o Banco de Dados

namespace App\Models;

class Model
{
    public $primaryKey = "id";
    public $id;
    public $table;
    public $fillables = [];
    public $data;
    protected $hidden = [];
    protected $connection;

    // Timestamps para created_at e updated_at
    protected $timestamps = true;

    public function __construct()
    {
        try {
            $this->connection = new \PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASSWORD'));
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            return $this->response(['error' => $e->getMessage()]);
        }
    }

    // Validação simples de dados
    protected function validate(array $data)
    {
        // Exemplo: Validar e-mail
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return 'E-mail inválido';
        }
        
        // Validar campos obrigatórios
        foreach ($this->fillables as $field) {
            if (in_array($field, $this->requiredFields()) && empty($data[$field])) {
                return ucfirst($field) . ' é obrigatório';
            }
        }

        return true;
    }

    // Retorna os campos obrigatórios
    protected function requiredFields()
    {
        return ['name', 'email']; // Exemplo de campos obrigatórios
    }

    // Método de busca por ID
    public function find(int $id)
    {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $result = $this->connection->prepare($query);
            $result->bindParam(':id', $id);
            $result->execute();

            $this->data = $result->fetch(\PDO::FETCH_ASSOC);
            if (!isset($this->data)) {
                return false;
            }
            foreach ($this->hidden as $value) {
                unset($this->data[$value]);
            }

            $this->id = $this->data['id'];
            return $this;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para criar ou atualizar um registro
    public function save(array $data)
    {
        // Validação dos dados antes de salvar
        $validation = $this->validate($data);
        if ($validation !== true) {
            return $this->response(['error' => $validation]);
        }

        // Preenche timestamps automaticamente
        if ($this->timestamps) {
            $now = date('Y-m-d H:i:s');
            if (!isset($data['created_at'])) {
                $data['created_at'] = $now;
            }
            $data['updated_at'] = $now;
        }

        // Criação ou atualização
        if (isset($data['id']) && $data['id'] > 0) {
            return $this->update($data);
        } else {
            return $this->create($data);
        }
    }

    // Criação de um novo registro
    public function create(array $data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillables) && !in_array($key, $this->hidden)) {
                unset($data[$key]);
            }
        }

        $pdo_keys = implode(",", $this->fillables);
        $pdo_keys .= count($this->hidden) > 0 ? "," . implode(',', $this->hidden) : null;
        $pdo_params = '';

        foreach ($this->fillables as $value) {
            $pdo_params .= ":" . $value . ",";
        }

        foreach ($this->hidden as $value) {
            $pdo_params .= ":" . $value . ",";
        }

        $pdo_params = substr($pdo_params, 0, -1);

        $query = "INSERT INTO " . $this->table . " (" . $pdo_keys . ") VALUES (" . $pdo_params . ")";

        try {
            $sql = $this->connection->prepare($query);

            foreach ($this->fillables as &$key) {
                $sql->bindParam(':' . $key, $data[$key]);
            }

            foreach ($this->hidden as &$key) {
                $sql->bindParam(':' . $key, $data[$key]);
            }

            $sql->execute();
            $this->id = $this->connection->lastInsertId();
            $this->find($this->id);
            return $this;
        } catch (\PDOException $e) {
            return $this->response(['error' => $e->getMessage()]);
        }
    }

    // Atualiza um registro existente
    public function update(array $data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillables) && !in_array($key, $this->hidden)) {
                unset($data[$key]);
            }
        }
        if (count($data) == 0) {
            die('Nenhum parametro correspondente a classe informado.');
        }

        $pdo_data = '';
        foreach ($data as $key => $value) {
            $pdo_data .= $key . " = :" . $key . ", ";
        }

        $pdo_data = substr($pdo_data, 0, -2);

        try {
            $query = "UPDATE " . $this->table . " SET " . $pdo_data . " WHERE id = :id";
            $sql = $this->connection->prepare($query);
            $sql->bindParam(':id', $this->id);
            foreach ($data as $key => &$value) {
                $sql->bindParam(':' . $key, $value);
            }

            $sql->execute();

            $this->find($this->id);
            return $this;
        } catch (\PDOException $e) {
            return $this->response(['error' => $e->getMessage()]);
        }
    }

    // Deleta um registro
    public function delete(int $id = null)
    {
        $id = $id ?: $this->id;
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $result = $this->connection->prepare($query);
            $result->bindParam(':id', $id);

            return $result->execute();
        } catch (\PDOException $e) {
            return $this->response(['error' => $e->getMessage()]);
        }
    }

    // Relacionamento "hasMany"
    public function hasMany($relatedModel, $foreignKey)
    {
        $relatedModelInstance = new $relatedModel;
        return $relatedModelInstance->where($foreignKey, '=', $this->id);
    }

    // Resposta em formato JSON
    public function response(array $data, int $httpCode = 200)
    {
        header("HTTP/1.0 " . $httpCode);
        header('Content-type: application/json');
        die(json_encode($data));
    }
}
