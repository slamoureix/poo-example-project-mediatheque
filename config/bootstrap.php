<?php

$config = [
    "DB_USER" => "root",
    "DB_PSWD" => "root",
    "DB_HOST" => "localhost",
    "DB_PORT" => "8889",
    "DB_NAME" => "hblibrary",
];

require_once __DIR__ .'/../lib/Model/Book.php';
require_once __DIR__ .'/../lib/Service/BookManager.php';
require_once __DIR__ .'/../lib/Service/Container.php';

$container = new Container($config);