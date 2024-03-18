## Sorbe o projeto

Este projeto implementa o teste para desenvolvedor sênior back-end da YMonetize

## Requisitos do ambiente de desenvolvimento

-   PHP 8.3.x
-   Docker
-   Composer
-   VS Code
-   Rabbitmq (brew install rabbitmq)

## Configurando seu ambiente

Este projeto faz uso da ferramenta Laravel Sail. Mais informações sobre ela consulte [aqui](https://laravel.com/docs/11.x#sail-on-macos).


1. Instale os pacotes usando o comando:

```
composer install
```

2. Adicione essas veriaveis ao .env

```
RABBITMQ_HOST=localhost
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASS=guest
RABBITMQ_VHOST=/
```

3. Execute o Laravel Sail com o comando (o '-d' serve para executar em segundo plano e poder fazer os demais comandos)
    
```
./vendor/bin/sail up -d
```

## Rodando testes

-   Foram criados testes com o phpUnit escritos pa pasta "tests/Unit/Test.php"

-   Para rodar os testes, acesse o terminal do container laravel.test-1 execute o comando:

```
php artisan test
```

-   Caso queria executar testes separadamente execute o comando:

```
php artisan test --filter test_performance_and_optimization
php artisan test --filter test_data_structure_and_algorithms
php artisan test --filter test_architecture_and_design_patterns
php artisan test --filter test_advanced_security
php artisan test --filter test_integration_and_microservices
```