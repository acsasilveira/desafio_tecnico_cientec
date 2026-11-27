<?php

declare(strict_types=1);

namespace Acsa\SistemaCidadao\Controller;

use Acsa\SistemaCidadao\Model\Cidadao;
use Acsa\SistemaCidadao\Repository\CidadaoRepository;
use Acsa\SistemaCidadao\Validators\ValidarCPF;

class CidadaoController
{
    private CidadaoRepository $repository;
    private ValidarCPF $validador;

    public function __construct()
    {
        $this->repository = $repository ?? new CidadaoRepository();
        $this->validador = new ValidarCPF();
    }


    public function cadastrar(string $nome, string $cpf): array {
        // Removendo espaços excedentes do nome (e deixando em caps) e do cpf
        $nome = mb_strtoupper(trim($nome), 'UTF-8');
        $cpf = trim($cpf);

        if ($nome === '' || $cpf === '') {
            return [
                'sucesso' => false,
                'mensagem' => 'Preencha todos os campos.'
            ];
        }

        // Validando o CPF antes de cadastrar
        if (!$this->validador->validar($cpf)) {
            return [
                'sucesso' => false,
                'mensagem' => 'CPF inválido.'
            ];
        }

        // Verifica se o CPF já está cadastrado.
        if ($this->repository->buscarPorCpf($cpf) !== null) {
            return [
                'sucesso' => false,
                'mensagem' => 'CPF já cadastrado.'
            ];
        }

        // Remove a formatação do CPF.
        $cpf = preg_replace('/\D/', '', $cpf);

        // Cria o objeto cidadão.
        $cidadao = new Cidadao($nome, $cpf);

        // Solicita ao Repository que salve o cidadão.
        $salvo = $this->repository->cadastrar($cidadao);

        // Retorna o resultado da operação.
        return [
            'sucesso' => $salvo,
            'mensagem' => $salvo
                ? "Cidadão com nome: {$nome} e cpf: {$cpf} cadastrado com sucesso!"
                : 'Não foi possível cadastrar o cidadão. Tente novamente.'
        ];
    }

    public function buscarPorNome(string $nome): array{
        
        $nome = trim($nome);

        if ($nome === '') {
            return [
                'sucesso' => false,
                'mensagem' => 'Informe o nome do cidadão.',
                'cidadaos' => []
            ];
        }

        $cidadaos = $this->repository->buscarPorNome($nome);

        // Verifica se algum cidadão foi encontrado.
        if (empty($cidadaos)) {
            return [
                'sucesso' => false,
                'mensagem' => 'Cidadão não encontrado.',
                'cidadaos' => []
            ];
        }

        // Retorna os cidadãos encontrados.
        return [
            'sucesso' => true,
            'mensagem' => "Foi encontrado cidadão(s/ã/ãs) com nome {$nome}",
            'cidadaos' => $cidadaos
        ];
    }

    public function buscarPorCpf(string $cpf): array{
        
        $cpf = trim($cpf);

        if ($cpf === '') {
            return [
                'sucesso' => false,
                'mensagem' => 'Informe o cpf do cidadão.',
                'cidadaos' => []
            ];
        }

        // Remove a formatação do CPF
        $cpf = preg_replace('/\D/', '', $cpf);

        // Validando o CPF antes de pesquisar
        if (!$this->validador->validar($cpf)) {
            return [
                'sucesso' => false,
                'mensagem' => 'CPF inválido.'
            ];
        }

        $cidadao = $this->repository->buscarPorCpf($cpf);

        if ($cidadao == null) {
            return [
                'sucesso' => false,
                'mensagem' => 'Cidadão não encontrado.',
                'cidadaos' => null
            ];
        }

        // Retorna os cidadãos encontrados.
        return [
            'sucesso' => true,
            'mensagem' => "Foi encontrado um(a) cidadão(ã) com o CPF informado: {$cpf}.",
            'cidadao' => $cidadao
        ];
    }

}