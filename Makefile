.DEFAULT_GOAL=help
WORKSPACE_NAME=$(shell docker-compose ps -q workspace)
MYSQL_CONTAINER=$(shell docker-compose ps -q mysql)

.PHONY: help init build serve stop restart down artisan npm tinker migrate workspace composer lint fix refactor phpstan try-refactor test mysql

help: ## Display this help screen
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

init: ## Install the project
	cp -n .env.example .env
	@make -s build
	@make -s serve
	@make -s composer
	@docker exec --user app ${WORKSPACE_NAME} /bin/bash -c "php artisan key:generate"
	@docker exec --user app ${WORKSPACE_NAME} /bin/bash -c "php artisan migrate:fresh --seed"

build: ## Rebuild the containers
	@docker-compose build

start: ## Start the docker containers
	-@docker network create traefik 2>/dev/null || true
	@docker-compose up --remove-orphans -d

serve: ## Start alias
	@make -s start

stop: ## Stop the docker server
	@docker-compose stop

restart: ## Restart the docker server
	@docker-compose restart

down: ## Stop the docker server and remove containers
	@docker-compose down

destroy: ## Remove containers, images and volumes
	@docker-compose down --rmi all --volumes

artisan: ## Run an artisan command into the workspace container
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "php artisan ${cmd}"

npm: ## Run npm cli
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "npm ${cmd}"

tinker: ## Run laravel tinker
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "php artisan tinker"

migrate: ## Run laravel migrations
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "php artisan migrate"

workspace: ## "SSH" into the workspace container
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash

composer: ## Install composer dependencies
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "composer install"

lint: ## Run linter
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/php-cs-fixer fix --config=.php_cs.dist --dry-run --diff"

fix: ## Run php-cs-fixer
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/php-cs-fixer fix --config=.php_cs.dist --diff"

try-refactor: ## Run rector in dry-run mode
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/rector process --config rector.php --dry-run"

refactor: ## Use rector
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/rector process --config rector.php"

phpstan: ## Run phpstan
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/phpstan analyse --memory-limit=-1"

test: ## Run test suit
	@docker exec -it --user app ${WORKSPACE_NAME} /bin/bash -c "vendor/bin/phpunit --stop-on-error"

mysql: ## Execute the MySQL CLI
	@docker exec -it ${MYSQL_CONTAINER} /bin/bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'