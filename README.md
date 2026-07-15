
# Comando
## composer create-project laravel/laravel meu-projeto
## cd meu-projeto
## composer require laravel/sail --dev
## php artisan sail:install
## No application encryption key has been specified.
### ./vendor/bin/sail artisan key:generate

### ./vendor/bin/sail artisan migrate

### Limpar os caches
sail artisan config:clear
sail artisan cache:clear
sail artisan optimize:clear


## Criar Controller
### ./vendor/bin/sail artisan make:controller

### php artisan make:migration create_users_table

# TABELAS
## USERS
-----------------
id
username
password
last_login
created_at
updated_at
deleted_at

## NOTES
-----------------
id
user_id
title
text
created_at
updated_at
deleted_at

### ./vendor/bin/sail artisan migrate
### ./vendor/bin/sail artisan migrate:rollback

### php artisan make:seeder UsersTableSeeder

### php artisan make:model User

### ./vendor/bin/sail artisan db:seed UsersTableSeeder
