# joinads-app
# Projeto JoinADS - Teste Laravell
## CRUD Domains and Blocks

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

Domínios (domains)
●	GET /api/domains → Lista todos os domínios.
●	POST /api/domains → Cria um novo domínio.
●	PUT /api/domains/{id} → Atualiza um domínio existente.
●	DELETE /api/domains/{id} → Exclui um domínio.
Blocos (blocks)
●	GET /api/blocks → Lista todos os blocos.
●	POST /api/blocks → Cria um novo bloco.
●	PUT /api/blocks/{id} → Atualiza um bloco existente.
●	DELETE /api/blocks/{id} → Exclui um bloco.


## Clonando o Repositório

Para clonar este repositório, execute o seguinte comando:

```bash
git clone https://github.com/gstavoscherer/joinads-app.git
```

Navegue até o diretório do projeto:
```bash
cd joinads-app
```
Instale as dependências do Composer:
```bash
composer install
```
Copie o arquivo .env.example para .env:
```bash
copy .env.example .env
```
Gere a chave de aplicativo:
```bash
php artisan key:generate
```
Configurar o Banco de Dados:

No arquivo .env, configure as variáveis de ambiente para o MySQL:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```
Criar o Banco de Dados:

No MySQL, crie o banco de dados:
```bash
CREATE DATABASE nome_do_banco;
```
Executar as Migrations:

No terminal, execute:
```bash
php artisan migrate
```
Instalar o Pest PHP:
```bash
composer require pestphp/pest --dev --with-all-dependencies
```
Rodar o Servidor:
Inicie o servidor embutido do Laravel:
```bash
php artisan serve
```
O projeto estará disponível em http://127.0.0.1:8000.

Rodar os Testes:

Para rodar os testes, utilize o comando:
```bash
php artisan test
```

OBS:
Projeto foi desenvolvido em uma versão anterior do PHP, sendo necessário fazer alguns ajustes. Coloquei na pasta Utilidades uma Pasta chamada PHP, aonde está a versão completa utilizada por essa API
Faça a instalação do composer apostando o .exe dessa versão disponibilizada, depois digite 'composer update no terminal'.
