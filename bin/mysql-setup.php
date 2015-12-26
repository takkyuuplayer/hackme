<?php
require_once __DIR__ . '/../vendor/autoload.php';

$pdo = \Hackme\Heroku\ClearDB::getConnection();

$pdo->exec(file_get_contents(__DIR__ . '/../etc/schema/hackme.sql'));
$pdo->exec(file_get_contents(__DIR__ . '/../etc/schema/dummy-data.sql'));

foreach ($pdo->query('SHOW TABLES') as $row) {
    print($row[0] . PHP_EOL);
}
