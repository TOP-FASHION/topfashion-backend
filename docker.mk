include .env

.PHONY: up down stop prune ps shell wp logs

default: up

WP_ROOT ?= /var/www/html/

up-dev:
	@echo "Starting up DEV containers for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d --remove-orphans

up-prod:
	@echo "Starting up PROD containers for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml up -d --remove-orphans

down: stop

stop:
	@echo "Stopping containers for $(PROJECT_NAME)..."
	@docker-compose stop

prune:
	@echo "Removing containers for $(PROJECT_NAME)..."
	@docker-compose down -v

ps:
	@docker ps --filter name='$(PROJECT_NAME)*'

shell:
	docker exec -ti -e COLUMNS=$(shell tput cols) -e LINES=$(shell tput lines) $(shell docker ps --filter name='$(PROJECT_NAME)_php' --format "{{ .ID }}") sh

wp:
	docker exec $(shell docker ps --filter name='$(PROJECT_NAME)_php' --format "{{ .ID }}") wp --path=$(WP_ROOT) $(filter-out $@,$(MAKECMDGOALS))

logs:
	@docker-compose logs -f $(filter-out $@,$(MAKECMDGOALS))

# https://stackoverflow.com/a/6273809/1826109
%:
	@: