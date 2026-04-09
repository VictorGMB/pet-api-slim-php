<?php

namespace Projeto\ApiPets\DAO;

use Projeto\ApiPets\Model\Tipo;
use \PDO;

class TipoDAO {
    private PDO $conexao;

    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }

    public function create(Tipo $tipo): bool {
        $sql = "INSERT INTO tipos (nome) VALUES (:nome)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $tipo->getNome());
        return $stmt->execute();
    }

    public function findAll(): array {
        $sql = "SELECT * FROM tipos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array|bool {
        $sql = "SELECT * FROM tipos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Tipo $tipo): bool {
        $sql = "UPDATE tipos SET nome = :nome WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $tipo->getNome());
        $stmt->bindValue(':id', $tipo->getId());
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM tipos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}