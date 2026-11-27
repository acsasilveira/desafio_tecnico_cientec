<?php

declare(strict_types=1);

namespace Acsa\SistemaCidadao\Model;

class Cidadao {

    private ?int $id = null;
    private string $nome;
    private string $cpf;

    public function __construct(string $nome, string $cpf, ?int $id = null){
        $this->id = $id;    
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    // Getters e Setters
    public function getId(): ?int{
        return $this->id;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getCpf(): string{
        return $this->cpf;
    }
}

?>