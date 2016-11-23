
.PHONY: default
default: up;

clean:
	@echo " -> Cleaning up..."
	rm -r vendor/ public/static/vendor/ node_modules/

verify:
	@echo " -> Verifing Installations..."
	@echo " -> Verify php, composer"
	which php composer
	@echo " -> Verify node, npm, gulp"
	which node npm gulp
	@echo " -> Verify docker, docker-compose"
	which docker docker-compose
	@echo " -> All Installations OK..."

build: verify
	@echo " -> Building..."
	composer install
	npm install
	gulp
	@echo " -> Build Successful!!!"

up: build
	@echo " -> Setting Up Docker Containers..."
	docker-compose up -d
	@echo " -> Running on http://0.0.0.0/"

down:
	@echo " -> Tearing Down Docker Containers..."
	docker-compose down -v
	@echo " -> Docker Services Ends Up"
