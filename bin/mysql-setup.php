<?php
require_once __DIR__ . '/../vendor/autoload.php';

$pdo = \Hackme\Heroku\ClearDB::getConnection();

foreach (['hackme.sql', 'dummy-data.sql'] as $sql) {
    $query = file_get_contents(__DIR__ . "/../etc/schema/$sql");
    if ($pdo->exec($query) === false) {
        die(print_r($pdo->errorInfo(), true));
    }
}
