# How to run
- copy .env.example into .env
  ```
  cd laravel
  cp .env.example .env
  composer install
  php artisan key:generate
  touch storage/app/database.sqlite
  ```
  
- migrate database structure (diem rate seeds will load automatically):
  ```
  php artisan migrate fresh
  ```
  
- Run tests:
  ```
  php artisan test
  ```
# Dev tools
- php-cs-fixer
  ```
  composer php-cs-fixer
  ```
- phpstan
  ```
  composer phpstan
  ```


# Project structure
- two business domains: 
  - **BusinessTrip** - place where BusinessTrip is created and DiemRate is calculated
  - **Employee** - part of application related to the Employee managment
- **Contracts** - interfaces which are inter domains and are used by Laravel app 
- **UseCases** - use cases in application
- **laravel** - Laravel application with controllers and tests

# My personal assumptions
- technology stack:
  - PHP 8.2.6
  - XDebug 3.2.0
  - SQlite 3
  - Laravel framework v10.13.2
  - PHPUnit 10.2.1
  - PHPStan 1.10.16
- no API authorization
- prepared OpenAPI documentation has only happy path (success)
- calculated diem rate is type integer
- currencies short code based on ISO 4217 standard
- Illuminate\Support\Carbon as DateTime representation
- Illuminate\Support\Collection as Collection representation
- list of acceptable countries where business trip can be made is in database, together with diem rate value
