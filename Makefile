PHP=$(shell which php)
CURL=$(shell which curl)

all: setup mysql_setup

setup:
	$(PHP) composer.phar install

mysql_setup:
	$(PHP) ./bin/mysql-setup.php

composer_install:
	$(CURL) -s https://getcomposer.org/installer | php

test:
	./vendor/bin/phpunit --bootstrap vendor/autoload.php tests

local:
	mysql -uroot <./etc/schema/local/database.sql
debug:
	$(PHP) -S 192.168.33.101:8080 -t web/

help:
	cat Makefile
