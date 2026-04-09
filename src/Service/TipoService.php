<?php

namespace Projeto\ApiPets\Service;

use Projeto\ApiPets\DAO\TipoDAO;
use Projeto\ApiPets\Model\Tipo;
use \Exception;

class TipoService {
    private TipoDAO $tipoDAO;

    public function __construct(TipoDAO $tipoDAO) {
        $this->tipoDAO = $tipoDAO;
    }

    public function create(Tipo $tipo): bool {
        if (empty($tipo->getNome())) {
            throw new Exception("O nome do tipo é obrigatório.");
        }
        return $this->tipoDAO->create($tipo);
    }

    public function findAll(): array {
        return $this->tipoDAO->findAll();
    }

    public function findById(int $id): array {
        $tipo = $this->tipoDAO->findById($id);
        if (!$tipo) {
            throw new Exception("Tipo não encontrado.");
        }
        return $tipo;
    }

    public function update(Tipo $tipo): bool {
        $this->findById($tipo->getId());
        return $this->tipoDAO->update($tipo);
    }

    public function delete(int $id): bool {
        $this->findById($id);
        return $this->tipoDAO->delete($id);
    }
}
