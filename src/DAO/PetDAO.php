<?php

namespace Projeto\ApiPets\DAO;

use Projeto\ApiPets\Model\Pet;
use \PDO;

class PetDAO {
    private PDO $conexao;

    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }

    public function create(Pet $pet): bool {
        $sql = "INSERT INTO pets (nome, id_tipo) VALUES (:nome, :id_tipo)";
        
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(':nome', $pet->getNome());
        $stmt->bindValue(':id_tipo', $pet->getIdTipo());
        
        return $stmt->execute();
    }

    public function findAll(): array {
        $sql = "SELECT * FROM pets";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array|bool {
        $sql = "SELECT * FROM pets WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Pet $pet): bool {
        $sql = "UPDATE pets SET nome = :nome, id_tipo = :id_tipo WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(':nome', $pet->getNome());
        $stmt->bindValue(':id_tipo', $pet->getIdTipo());
        $stmt->bindValue(':id', $pet->getId());
        
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM pets WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
}