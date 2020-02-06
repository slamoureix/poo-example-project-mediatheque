<?php
require_once __DIR__ . '/../../config/bootstrap.php';

$value = $_GET['value'];
$field = $_GET['field'];

$books = $container->getBookManager()->findByField($field, $value);

var_dump($books);