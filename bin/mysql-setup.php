<?php
require_once __DIR__ . '/../vendor/autoload.php';

$pdo = \Hackme\Heroku\ClearDB::getConnection();

$pdo->exec(file_get_contents(__DIR__ . '/../etc/schema/hackme.sql')) or die(print_r($pdo->errorInfo(), true));
$pdo->exec(file_get_contents(__DIR__ . '/../etc/schema/dummy-data.sql')) or die(print_r($pdo->errorInfo(), true));
