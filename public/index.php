
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidadãos Brasileiros</title>
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

        <section class="text-center text-white">
            <h1 class="display-3 fw-bold">Cidadãos Brasileiros</h1>

            <p class="lead">
                Sistema de Cadastro e Consulta de Cidadãos
            </p>
        </section>

    </main>

    <footer class="text-center py-3 bg-white">
        <p class="mb-0">
            © 2026, Acsa Silveira. Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>
