
[![Catho Online](http://static.catho.com.br/svg/site/logoCathoB2c.svg)](http://www.catho.com.br)

# Backend-Test
Uma pessoa esta a procura de emprego e dentre as várias vagas que existem no mercado (disponibilizadas nesse [JSON](data/vagas.json)) e ela quer encontrar vagas que estejam de acordo com o que ela saiba fazer, seja direto pelo cargo ou atribuições que podem ser encontradas na descrição das vagas. Para atender essa necessidade precisamos:

- uma API simples p/ procurar vagas (um GET p/ procurar as vagas no .json disponibilizado);
- deve ser possível procurar vagas por texto (no atributos title e description);
- deve ser possível procurar vagas por uma cidade;
- deve ser possível ordenar o resultado pelo salário (asc e desc);

## Instruções
Criei um `Makefile` para facilitar as coisas.
```sh
make # make up

make verify # verifica oq precisa no $PATH
make deps   # scripts de dependencias
make build  # empacotação, gerar arquivos estáticos
make up     # serviços docker

make up     # verifica gerenciadores de pacotes
            # faz build
            # levanta serviços no docker compose

make down   # desliga os containers e seus volumes

make clean   # remove arquivos e pastas de dependencias
```

### Para o projeto funcionar é necessário:
* [Docker](https://www.docker.com/)
    * [Docker Compose](https://docs.docker.com/compose/)
* [PHP](http://php.net/)
    * [Composer](https://getcomposer.org/)
* [NodeJS](https://nodejs.org/)
    * [NPM](https://www.npmjs.com/)
    * [Bower](https://bower.io/)
    * [Gulp](http://gulpjs.com/)

##### Hands on command:
* composer: `$ composer install`
* npm: `$ npm install`
* gulp: `$ gulp` ou `node_modules/.bin/gulp`
* docker: `$ docker-compose up -d`

##### Endpoints
* `GET /api/position/locations` <- Lista de cidades com vagas
* `GET /api/position` <- Vagas disponíveis
    * Parametros:
    * `title` <- Procurar no campo de título
    * `description` <- Procurar no campo descrição
    * `salary_order` <- Ordenar resultado pelo salário `asc`, `desc`

## TODO:
* Testes
