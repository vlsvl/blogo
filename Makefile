#Helpers
DC = docker-compose
EXEC = ${DC} exec
PHP = ${EXEC} php
ARTISAN = ${PHP} ./artisan

##
##Environment
##-------------
start: ## Start app environment
	$(DC) up -d --remove-orphans --no-recreate

build: ## Build app environment and start
	$(DC) up -d --build

stop: ## Stop app environment
	$(DC) down

chown: ## Change owner for all files in project to 1000:1000
	$(PHP) chown -R 1000:1000 ./

##
##Database
##------------
migrate: ## Run migrate command in php container
	$(ARTISAN) migrate

##
##Tests && QA
##-------------
test: ## Run tests
	php artisan test

coverage: ## run tests with coverage
	php artisan test --coverage

coverage-text: ## Test coverage
	$(EXEC_PHP) vendor/bin/phpunit --coverage-text

coverage-html: ## Tests coverage (xdebug need in coverage mode)
	${PHP} vendor/bin/phpunit --coverage-html tmp/coverage

phpcs: ## Run phpcode_sniffer
	$(EXEC_PHP) vendor/bin/phpcs ./app

php-cs-fixer: ## Run PHP-CS-FIXER
	$(EXEC_PHP) vendor/bin/php-cs-fixer fix ./app --verbose

php-cs-fixer.dry-run: ## Run php-cs-fixer in dry-run mode
	$(EXEC_PHP) vendor/bin/php-cs-fixer fix ./app --verbose --diff --dry-run

phpmd: ## Run PHPMD
	$(EXEC_PHP) vendor/bin/phpmd app text ./phpmd.xml.dist

psalm: ## Run psalm with info
	$(PHP) vendor/bin/psalm --show-info=true

psalm-fix: ## Run psalm with auto fix
	$(PHP) vendor/bin/psalm --alter --issues=MissingReturnType --dry-run

phpstan: ## Run analyze with phpstan
	$(PHP) vendor/bin/phpstan analyse ./app

##
##Helpers
##-------------
link-storage: ## Create link for storage folder
	${ARTISAN} storage:link

opt-clear: ## Clear all optimize
	${ARTISAN} optimize:clear

cache-clear: ## Clear cache
	${ARTISAN} cache:clear

clear: opt-clear cache-clear ## Clear all

php: ## Start application container
	${PHP} /bin/sh

tinker: ## Run tinker in container
	${ARTISAN} tinker

feature: ## Run command for test some feature. Sometimes better use command then tinker (Command added to gitignore)
	${ARTISAN} feature


##
##Work with browser
##---------------
open-site: ## Open site in default browser
	nohup xdg-open http://blogo.test

open-mail: ## Open mailhog in default browser
	nohup xdg-open http://localhost:8025


.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
