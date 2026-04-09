<?php

namespace Projeto\ApiPets\Model;

class Tipo {
    
    private int $id;
    private string $nome;

    public function __construct(int $id = 0, string $nome = "") {
        $this->setId($id);
        $this->setNome($nome);
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = ($id < 0) ? 0 : $id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = trim($nome);
    }
}