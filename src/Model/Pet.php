<?php

namespace Projeto\ApiPets\Model;

class Pet{

    private int $id;
    private string $nome;
    private int $id_tipo;

    public function __construct(int $id = 0, string $nome = "", int $id_tipo = 0) {
        $this->setId($id);
        $this->setNome($nome);
        $this->setIdTipo($id_tipo);
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

    public function getIdTipo(): int {
        return $this->id_tipo;
    }

    public function setIdTipo(int $id_tipo): void {
        $this->id_tipo = ($id_tipo < 0) ? 0 : $id_tipo;
    }
}
