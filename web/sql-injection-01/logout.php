<?php
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();
session_unset();
header('Location: index.php');
