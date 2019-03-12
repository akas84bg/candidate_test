.PHONY: all deps composer-install composer-update build test run-tests erase layer start-game

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

game:
	@docker exec -it bingo_kata-php make run-game

run-game:
	./app/bin/bingo

start:
	@docker-compose up -d

stop:
	@docker-compose stop

destroy:
	@docker-compose down

erase:
		docker-compose stop
		docker-compose rm -v -f
