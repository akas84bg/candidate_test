.PHONY: all deps composer-install composer-update build test run-tests erase layer run-game

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

deps: composer-install

composer-install:
	@docker run --rm --interactive --tty --volume $(current-dir):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo install \
			--no-ansi \
			--no-interaction

composer-update:
	@docker run --rm --interactive --tty --volume $(current-dir):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo update \
			--no-ansi \
			--no-interaction

build: deps start

test:
	@docker run --rm --interactive --tty --volume $(current-dir):/app --user $(id -u):$(id -g) \
    		gsingh1/prestissimo test

run-game:
	docker-compose exec php sh -lc './app/bin/console bingo:start'

start:
	@docker-compose up -d

stop:
	@docker-compose stop

destroy:
	@docker-compose down

erase:
		docker-compose stop
		docker-compose rm -v -f
