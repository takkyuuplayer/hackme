PHP=$(shell which php)
CURL=$(shell which curl)

all: setup

setup: composer_install
	$(PHP) composer.phar install

composer_install:
	$(CURL) -s https://getcomposer.org/installer | php

test:
	./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
