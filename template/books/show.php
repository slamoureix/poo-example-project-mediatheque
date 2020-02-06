<?php
require_once __DIR__ . '/../../config/bootstrap.php';


$book = $container->getBookManager()->findOneById($_GET['id']);

var_dump($book);