# Sistema de Cadastro e Consulta de Cidadãos

Aplicação web para cadastro e consulta de cidadãos, desenvolvida em PHP com orientação a objetos e arquitetura organizada em camadas.

## 1. Tecnologias utilizadas

- **PHP 8.1+** — linguagem de programação.
- **MySQL** — sistema de gerenciamento de banco de dados.
- **Composer** — gerenciamento de dependências e autoload.
- **PDO** — acesso ao banco de dados.
- **Bootstrap 5.3.3** — estilização da interface.
- **Apache** — servidor web utilizado no ambiente de desenvolvimento.

## 2. Pré-requisitos

Antes de iniciar, verifique se você possui:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) instalado, com Apache e MySQL.
- PHP 8.1 ou superior.
- [Composer](https://getcomposer.org/) instalado.
- Navegador web atualizado.

## 3. Instalação

### 3.1. Obter o projeto

Clone o repositório:

```bash
git clone https://github.com/acsasilveira/desafio_tecnico_cientec.git
```

Ou extraia o arquivo compactado do projeto.

Coloque a pasta com os arquivos clonados dentro `do diretório htdocs` do XAMPP:

```text
C:\xampp\htdocs\pasta
```

### 3.2. Instalar as dependências

Abra o terminal na pasta raiz do projeto, onde está localizado o arquivo `composer.json`, e execute:

```bash
composer install
```

Esse comando instala as dependências e configura o autoload da aplicação.

## 4. Configuração do banco de dados

### 4.1. Iniciar os serviços

No painel de controle do XAMPP, inicie os serviços:

- Apache;
- MySQL.

### 4.2. Criar o banco de dados

Acesse o phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Execute o script SQL disponibilizado no arquivo `database.sql`, localizado na raiz do projeto.

Esse procedimento cria o banco de dados e a tabela necessária para armazenar os cidadãos cadastrados.

### 4.3. Configurar a conexão

Verifique as configurações de conexão com o banco de dados no arquivo:

```text
app/Database/Connection.php
```

Certifique-se de que os parâmetros correspondem ao ambiente local:

- Host: `localhost`;
- Banco de dados: `sistema_cidadao`;
- Usuário: `root`;
- Senha: conforme a configuração do MySQL instalado.

## 5. Executar a aplicação

Com Apache e MySQL em execução, abra o navegador e acesse:

```text
http://localhost/pasta/public/
```

**Importante:** a aplicação deve ser acessada pelo diretório `public`, que contém o ponto de entrada (`index.php`) e os arquivos públicos do sistema.

## 6. Funcionalidades

### Cadastro de cidadãos

- Cadastro por nome completo e CPF;
- Validação automática do CPF;
- Armazenamento dos dados no banco de dados;
- Exibição de mensagem de confirmação após o cadastro.

### Consulta de cidadãos

- Pesquisa por CPF;
- Pesquisa por nome;
- Exibição dos dados encontrados;

## 7. Estrutura do projeto

```text
pasta/
├── app/
│   ├── Controller/
│   ├── Database/
│   ├── Model/
│   ├── Repository/
│   └── Validators/
├── public/
│   ├── css/
│   ├── img/
│   ├── cadastro.php
│   ├── index.php
│   └── pesquisa.php
├── vendor/
├── composer.json
├── composer.lock
└── database.sql
```

- `app/`: contém as classes e regras da aplicação.
- `Controller/`: gerencia as requisições e a comunicação entre as camadas.
- `Database/`: concentra a configuração e conexão com o banco de dados.
- `Model/`: representa as entidades do sistema.
- `Repository/`: realiza as operações de persistência e consulta.
- `Validators/`: contém as regras de validação.
- `public/`: disponibiliza os arquivos de acesso à aplicação.
- `vendor/`: contém as dependências instaladas pelo Composer.

## 8. Observações

- Os CPFs são armazenados no banco de dados somente com números, sem pontuação.
- O CPF deve ser válido para que o cadastro seja realizado.
- O banco de dados deve estar disponível para o funcionamento das operações de cadastro e consulta.