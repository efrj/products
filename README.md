# Produtos

## Rodando a API com Docker
Entre no diretório "products-api" 

``cd products-api`` 

Copie o arquivo ".env.example" para ".env"

``cp .env.example .env``

Execute o comando ``docker-compose up``

Acesse a API através da url "http://localhost:8000/api" 

A documentação da API pode ser visualizada na url: "http://localhost:8000/api/documentation" 

Na raís do projeto contem uma coleção de endpoints para importar no Postman ou Insomnia. O nome do arquivo é "Product-Endpoints.postman_collection".

# Rodando o Front-End 

Entre no diretório "products-front-end" 
``cd products-front-end`` 

Instale as dependências com o comando "yarn install" 

``yarn install`` 

Inicie o servidor com o comando "yarn serve"

``yarn serve`` 

Acesse a aplicação no browser na url: "http://localhost:8080"
 