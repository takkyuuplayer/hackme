PHP=$(shell which php)
CURL=$(shell which curl)

setup:
	$(CURL) -s https://getcomposer.org/installer | php

install: setup
	$(PHP) composer.phar install
