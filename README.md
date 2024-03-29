# Produtos

## Rodando a API com Docker
Entre no diretório "products-api" 

``cd products-api`` 

Copie o arquivo ".env.example" para ".env"

``cp .env.example .env``

Execute o comando ``docker-compose up`` 

Instale as dependências do projeto. 
Entre no container 

``docker container exec -it php.products-api /bin/bash`` 

Volte um diretório 

``cd ..``

Use o comando "composer install" 

``composer install`` 

Acesse a API através da url "http://localhost:8000/api" 

Execute o comando com o Docker para rodar as migrations no container do PHP 

``docker container exec -it php.products-api php /var/www/artisan migrate`` 

Execute os testes unitários no container do PHP. 
Entre no container 

``docker container exec -it php.products-api /bin/bash`` 

Volte um diretório 

``cd ..``

Use o comando "php artisan test" 

``php artisan test``

A documentação da API pode ser visualizada na url: "http://localhost:8000/api/documentation" 

Na raís do projeto contem uma coleção de endpoints para importar no Postman ou Insomnia. O nome do arquivo é "Product-Endpoints.postman_collection".

# Rodando a aplicação Front-End 

Entre no diretório "products-front-end" 
``cd products-front-end`` 

Instale as dependências com o comando "yarn install" 

``yarn install`` 

Inicie o servidor com o comando "yarn serve"

``yarn serve`` 

Acesse a aplicação no browser na url: "http://localhost:8080"
 
