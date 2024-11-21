### **DOCUMENTAÇÃO DE EXECUÇÃO E INSTALAÇÃO**

**Visão Geral**

Este projeto é um sistema backend desenvolvido em PHP, utilizando Composer para gerenciar dependências, PHPUnit para testes e Bootstrap para o frontend. A aplicação foi configurada para rodar sem servidores como WAMP ou XAMPP, utilizando o servidor embutido do PHP para facilitar o desenvolvimento.

**Requisitos**

Antes de começar, você precisará ter as seguintes ferramentas instaladas no seu sistema:

- PHP (versão 7.4 ou superior)

- Composer (para gerenciamento de dependências PHP)
- PHPUnit (para rodar os testes automatizados)

Você pode verificar se já tem essas ferramentas instaladas com os seguintes comandos no terminal:

```bash
php -v
composer -v
phpunit --version
```

**Instalação**

**1. Clonar o Repositório**

Primeiro, faça o clone do repositório para sua máquina local:
```bash
git clone https://github.com/seuusuario/seuprojeto.git

```
**2. Instalar Dependências com Composer**

Navegue até a pasta do projeto e execute o comando para instalar as dependências definidas no composer.json:
```bash
cd seuprojeto
composer install
```
Esse comando irá baixar e instalar todas as bibliotecas necessárias para o funcionamento do backend, incluindo o PHPUnit para testes.

**3. Configuração do Banco de Dados**

Caso o projeto utilize um banco de dados, você precisará configurar as credenciais no arquivo de configuração, geralmente chamado de db.php ou config.php. As informações de configuração podem incluir:

- $host = 'localhost';
- $port = 'numero da porta';
- $dbname = 'nome do banco';
- $user = 'nome do usuario';
- $password = 'senha do banco';

Exemplo de configuração:
```bash
$host = 'localhost';
$port = '5432';
$dbname = 'root;
$user = 'postgres';
$password = 'password';

```
**4. Rodar o Servidor PHP**

Para rodar o servidor PHP localmente, sem a necessidade de WAMP ou XAMPP, use o servidor embutido do PHP com o seguinte comando:
```bash
php -S localhost:8000
```
Isso fará o servidor rodar na URL http://localhost:8000. Você pode acessar o backend pela URL ou integrar com o frontend (usando Bootstrap, por exemplo).

### **Testes**
O projeto utiliza o PHPUnit para testes. Para rodá-los, basta executar o seguinte comando na raiz do projeto:
```bash
./vendor/bin/phpunit
```
Isso irá rodar todos os testes presentes na pasta de testes (geralmente tests ou tests/Unit).

Se preferir rodar um teste específico, use o comando abaixo, substituindo o caminho do teste:
```bash
./vendor/bin/phpunit tests/SeuTeste.php
```

<br><br><br>

<h1 style="color: green;">FIM !!!!</h1>




