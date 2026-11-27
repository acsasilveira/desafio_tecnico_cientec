<?php

declare(strict_types=1);

namespace Acsa\SistemaCidadao\Repository;

use Acsa\SistemaCidadao\Database\Connection;
use Acsa\SistemaCidadao\Model\Cidadao;
use PDO;

class CidadaoRepository
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Connection::getConnection();
    }

    public function cadastrar(Cidadao $cidadao):bool{
        $sql = "INSERT INTO cidadaos (nome, cpf) VALUES (:nome, :cpf)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(":nome", $cidadao->getNome());
        $stmt->bindValue(":cpf", $cidadao->getCpf());

        return $stmt->execute();
    }

    public function buscarPorNome(string $nome): ?array {
        # Permite pesquisar com pedaço do nome
        $sql = "SELECT id, nome, cpf FROM cidadaos WHERE upper(nome) LIKE :nome ORDER BY nome ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(':nome', "%{$nome}%");

        $stmt->execute();

        $dados = $stmt->fetchAll();

        // Se não encontrar nenhum registro com aquele nome
        if (!$dados){
            return null;
        }

        // Podem ter nomes iguais com CPFs diferentes
        $cidadaos = [];

        foreach ($dados as $registro){
            $cidadaos[] = new Cidadao($registro['nome'], $registro['cpf'], (int) $registro['id']);
        }

        return $cidadaos;

    }

    public function buscarPorCpf(string $cpf): ?Cidadao {
        $sql = "SELECT id, nome, cpf FROM cidadaos WHERE cpf = :cpf";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(":cpf", $cpf);

        $stmt->execute();

        $dados = $stmt->fetch();

        // Se não encontrar o registro com aquele CPF
        if (!$dados){
            return null;
        }

        $cidadao = new Cidadao($dados['nome'], $dados['cpf'], (int) $dados['id']);
        return $cidadao;

    }
}
?>