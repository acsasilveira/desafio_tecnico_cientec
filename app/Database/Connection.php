<?php

declare(strict_types=1);

namespace Acsa\SistemaCidadao\Database;

use PDO;

class Connection
{
    public static function getConnection(): PDO
    {
        // Configurações de acesso ao banco de dados.
        $host = 'localhost';
        $database = 'sistema_cidadao';
        $username = 'root';
        $password = '';

        // Define o endereço de conexão e a codificação dos caracteres.
        $dsn = "mysql:host={$host};dbname={$database};charset=utf8mb4";

        // Configura o comportamento do PDO.
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        // Estabelece e retorna a conexão.
        return new PDO($dsn, $username, $password, $options);
    }
}

?>