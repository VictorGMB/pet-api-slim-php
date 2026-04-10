<?php

namespace Projeto\ApiPets\Service;

use Projeto\ApiPets\DAO\PetDAO;
use Projeto\ApiPets\DAO\TipoDAO;
use Projeto\ApiPets\Model\Pet;
use \Exception;

class PetService {
    private PetDAO $petDAO;
    private TipoDAO $tipoDAO;

    public function __construct(PetDAO $petDAO, TipoDAO $tipoDAO) {
        $this->petDAO = $petDAO;
        $this->tipoDAO = $tipoDAO;
    }

    public function create(Pet $pet): bool {
        if (empty($pet->getNome())) {
            throw new Exception("O nome do pet é obrigatório.");
        }

        $tipoExistente = $this->tipoDAO->findById($pet->getIdTipo());
        if (!$tipoExistente) {
            throw new Exception("O tipo de animal informado (ID " . $pet->getIdTipo() . ") não existe.");
        }

        return $this->petDAO->create($pet);
    }

    public function findAll(): array {
        return $this->petDAO->findAll();
    }

    public function findById(int $id): array {
        $pet = $this->petDAO->findById($id);
        if (!$pet) {
            throw new Exception("Pet não encontrado.");
        }
        return $pet;
    }

    public function update(Pet $pet): bool {
        $this->findById($pet->getId());
        
        if (!$this->tipoDAO->findById($pet->getIdTipo())) {
            throw new Exception("O tipo informado não é válido.");
        }

        return $this->petDAO->update($pet);
    }

    public function delete(int $id): bool {
        $this->findById($id);
        return $this->petDAO->delete($id);
    }
}