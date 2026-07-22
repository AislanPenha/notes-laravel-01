# 🚀 Criando um Projeto Laravel com Sail

## 1. Criar o projeto

```bash
composer create-project laravel/laravel meu-projeto
cd meu-projeto
```

## 2. Instalar o Laravel Sail

```bash
composer require laravel/sail --dev
php artisan sail:install
```

## 3. Configurar o arquivo `.env`

Antes de iniciar o projeto, altere o nome do cookie de sessão para evitar conflitos com outros projetos Laravel.

```env
SESSION_COOKIE=notes_session
```

## 4. Gerar a chave da aplicação

Caso apareça a mensagem:

> No application encryption key has been specified.

Execute:

```bash
./vendor/bin/sail artisan key:generate
```

## 5. Iniciar os containers

```bash
./vendor/bin/sail up
```

> Para executar em segundo plano:

```bash
./vendor/bin/sail up -d
```

## 6. Executar as migrations

```bash
./vendor/bin/sail artisan migrate
```

---

# 🧹 Limpeza de Cache

Sempre que alterar configurações ou encontrar problemas de cache, execute:

```bash
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan optimize:clear
```

---

# 📦 Criando Componentes

## Criar um Controller

```bash
./vendor/bin/sail artisan make:controller NomeDoController
```

## Criar uma Migration

```bash
./vendor/bin/sail artisan make:migration create_users_table
```

## Criar um Model

```bash
./vendor/bin/sail artisan make:model User
```

## Criar um Seeder

```bash
./vendor/bin/sail artisan make:seeder UsersTableSeeder
```

---

# 🗄️ Estrutura das Tabelas

## Tabela `users`

| Campo | Tipo |
|--------|------|
| id | bigint |
| username | string |
| password | string |
| last_login | datetime |
| created_at | timestamp |
| updated_at | timestamp |
| deleted_at | timestamp |

---

## Tabela `notes`

| Campo | Tipo |
|--------|------|
| id | bigint |
| user_id | bigint (FK) |
| title | string |
| text | text |
| created_at | timestamp |
| updated_at | timestamp |
| deleted_at | timestamp |

---

# 🛠️ Comandos Úteis

## Executar as migrations

```bash
./vendor/bin/sail artisan migrate
```

## Desfazer a última migration

```bash
./vendor/bin/sail artisan migrate:rollback
```

## Executar um seeder específico

```bash
./vendor/bin/sail artisan db:seed --class=UsersTableSeeder
```

---

# 📋 Fluxo Resumido

```text
Criar projeto
      ↓
Instalar Sail
      ↓
Configurar .env
      ↓
Gerar APP_KEY
      ↓
Iniciar containers
      ↓
Executar migrations
      ↓
Criar Controllers, Models e Migrations
      ↓
Criar Seeders
      ↓
Popular o banco
```
