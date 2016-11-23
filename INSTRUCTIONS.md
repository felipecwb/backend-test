
# Instruções

Criei um `Makefile` para facilitar as coisas.

uso:
```sh
make # make up

make verify # verifica oq precisa no $PATH
make build  # scripts de dependencias e empacotação
make up     # serviços docker

make up     # verifica gerenciadores de pacotes
            # faz build
            # levanta serviços no docker compose

make down   # desliga os containers e seus volumes

make clen   # remove arquivos e pastas de dependencias
```

Para o projeto funcionar é necessário:
* [Docker](https://www.docker.com/)
    * [Docker Compose](https://docs.docker.com/compose/)
* [PHP](http://php.net/)
    * [Composer](https://getcomposer.org/)
* [NodeJS]((https://nodejs.org/)
    * [NPM](https://www.npmjs.com/)
    * [Bower](https://bower.io/)
    * [Gulp](http://gulpjs.com/)

Comandos:
* composer: `$ composer install`
* npm: `$ npm install`
* gulp: `$ gulp`
* docker: `$ docker-compose up -d`
