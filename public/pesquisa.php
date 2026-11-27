<?php

declare(strict_types=1);

// Carrega o autoload do Composer.
require_once __DIR__ . '/../vendor/autoload.php';

// Importa o Controller.
use Acsa\SistemaCidadao\Controller\CidadaoController;

// Inicializa o resultado como nulo.
$resultado = null;

// Verifica se o formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Recupera o termo pesquisado.
    $termo = $_GET['termo'] ?? '';

    // Recupera o tipo de pesquisa: nome ou cpf.
    $tipo = $_GET['tipo'] ?? '';

    try {
        // Instancia o Controller.
        $controller = new CidadaoController();

        // Executa a pesquisa conforme o tipo selecionado.
        if ($tipo === 'nome') {
            $resultado = $controller->buscarPorNome($termo);

        } elseif ($tipo === 'cpf') {
            $resultado = $controller->buscarPorCpf($termo);

        } else {
            // Trata um tipo de pesquisa inválido.
            $resultado = [
                'sucesso' => false,
                'mensagem' => 'Tipo de pesquisa inválido.'
            ];
        }

    } catch (PDOException $e) {
        // Registra o erro técnico no log.
        error_log("Erro ao pesquisar cidadão: " . $e->getMessage());

        // Apresenta uma mensagem genérica.
        $resultado = [
            'sucesso' => false,
            'mensagem' => 'Não foi possível realizar a pesquisa.'
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cidadão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar bg-white shadow-sm">
        <div class="container-fluid px-4 flex-column">

            <!-- Primeira linha: identidade e cadastro -->
            <div class="d-flex justify-content-between align-items-center w-100">

                <a class="navbar-brand fw-bold mb-0" href="index.php">
                    Cidadãos Brasileiros
                </a>

                <a href="cadastro.php" class="btn btn-outline-success">
                    Cadastrar
                </a>

            </div>

            <!-- Segunda linha: pesquisa -->
            <form action="pesquisa.php" method="GET"
                class="d-flex align-items-center justify-content-center gap-3 flex-wrap w-100 mt-3">

                <!-- Campo de pesquisa -->
                <input
                    type="search"
                    class="form-control"
                    name="termo"
                    placeholder="Pesquisar..."
                    style="max-width: 350px;"
                    required
                >

                <!-- Tipo de pesquisa -->
                <div class="d-flex gap-3">

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="tipo"
                            id="cpf"
                            value="cpf"
                            required
                        >
                        <label class="form-check-label" for="cpf">
                            CPF
                        </label>
                    </div>

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="tipo"
                            id="nome"
                            value="nome"
                        >
                        <label class="form-check-label" for="nome">
                            Nome
                        </label>
                    </div>

                </div>

                <button type="submit" class="btn btn-success">
                    Pesquisar
                </button>

            </form>

        </div>
    </nav>

    <main class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">

        <?php if ($resultado !== null): ?>

            <div class="card shadow p-4" style="width: 100%; max-width: 650px;">

                <?php if ($resultado['sucesso']): ?>

                    <h4 class="text-success mb-3">Cidadão encontrado!</h4>

                    <?php if ($tipo === 'nome'): ?>

                        <!-- Exibe todos os cidadãos encontrados pelo nome. -->
                        <?php foreach ($resultado['cidadaos'] as $cidadao): ?>

                            <div class="border rounded p-3 mb-2">
                                <p class="mb-1">
                                    <strong>Nome:</strong>
                                    <?= htmlspecialchars($cidadao->getNome()) ?>
                                </p>

                                <p class="mb-0">
                                    <strong>CPF:</strong>
                                    <?= htmlspecialchars($cidadao->getCpf()) ?>
                                </p>
                            </div>

                        <?php endforeach; ?>

                    <?php elseif ($tipo === 'cpf'): ?>

                        <!-- Exibe o único cidadão encontrado pelo CPF. -->
                        <p>
                            <strong>Nome:</strong>
                            <?= htmlspecialchars($resultado['cidadao']->getNome()) ?>
                        </p>

                        <p>
                            <strong>CPF:</strong>
                            <?= htmlspecialchars($resultado['cidadao']->getCpf()) ?>
                        </p>

                    <?php endif; ?>

                <?php else: ?>

                    <!-- Exibe mensagens de erro ou ausência de resultados. -->
                    <div class="alert alert-warning mb-0">
                        <?= htmlspecialchars($resultado['mensagem']) ?>
                    </div>

                <?php endif; ?>

            </div>

        <?php endif; ?>

    </main>


    <footer class="text-center py-3 bg-white">
        <p class="mb-0">
            © 2026, Acsa Silveira. Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>
