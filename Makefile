.DEFAULT_GOAL := help

init: ## Initialize the project
	if ! [ -f .env ];then cp .env.example .env;fi
	composer update -w
	composer dump-autoload -o
	npm install -f && npm run dev
	php artisan key:generate
	php artisan migrate:fresh
	php artisan passport:install
	php artisan db:seed --class=LaratrustSeeder
    php artisan vendor:publish --tag=laravel-mail
	php artisan event:generate
	php artisan optimize:clear
    php artisan storage:link

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
