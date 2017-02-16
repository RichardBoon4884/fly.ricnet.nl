<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);


require ROOT . 'controller/FlightsController.php';
require ROOT . 'core/core.php';

$controller = new FlightsController();

$controller->handleRequest();