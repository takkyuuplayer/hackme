<?php

require '../vendor/autoload.php';
require '../bin/mysql-setup.php';

$markdown = "

## SQL Injection

* [Q. 01](sql-injection-01/)
* [Q. 02](sql-injection-02/)

## Cross Site Request Forgery (CSRF)

* [Q. 01](csrf-01/login.php)
* [Q. 02](csrf-02/login.php)
";

$Parsedown = new Parsedown();
echo $Parsedown->text($markdown);
