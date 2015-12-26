PHP=$(shell which php)
CURL=$(shell which curl)
ifneq ("$(wildcard composer.phar)", "")
COMPOSER=./composer.phar
else
COMPOSER=composer
endif

all: composer-update composer-setup db-setup

composer-update:
	$(COMPOSER) self-update

composer-setup:
	$(COMPOSER) install

db-setup:
	$(PHP) ./bin/mysql-setup.php

test:
	./vendor/bin/phpunit --bootstrap tests/bootstrap.php tests

local:
	mysql -uroot <./etc/schema/local/database.sql

debug:
	$(PHP) -S 192.168.33.101:8080 -t web/

composer-install:
	$(CURL) -s https://getcomposer.org/installer | php

help:
	cat Makefile
