<?php

require '../vendor/autoload.php';

$markdown = "

## SQL Injection

* [Q. 01](sql-injection-01/index.php)

## Cross Site Request Forgery (CSRF)

* [Q. 01](csrf-01/login.php)
* [Q. 02](csrf-02/login.php)
";

$Parsedown = new Parsedown();
echo $Parsedown->text($markdown);
