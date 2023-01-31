# Teste Devio

### 

## Pre requisitos
Para executar o projeto é necessário já ter instalado o PHP, Composer e banco de dados SQLite, verificar na paǵina dos projetos como é a instalção de cada um
* [SQLite](https://sqlite.org/index.html)
* [PHP](https://www.php.net/manual/pt_BR/install.php)
* [Composer](https://getcomposer.org)

<br>

### Versões utilizadas
* SQLite 3.40
* PHP 8.0



## Instalação

Primeiramente devemos fazer o clone do repositório do github
```sh
git clone https://github.com/Jciel/teste-devio.git
```

<br>
<br>


Após o clone doprojeto, podemos entrar no diretório do projeto e instalar   
as dependências da aplicação
```sh
cd teste-devio

composer install
```

<br>

Após a isntalação das dependências podemos subir o projeto rodando localmente com o comando
```sh
php artisan serve
```
E podemos acessar o projeto com o endereço informado pelo comando

## API  
A API está documentada com Swegger e o arquivo de configuração está localizado em ``/public/openapi.json``.


### Testes  
Podemos executar os testes com o comando
```sh
composer test
```

### Seeder
Para executar os seeds para popular o banco de dados podemos executar o comando
```sh
php artisan db:seed
```
