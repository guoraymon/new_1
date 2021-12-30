<?php

require_once '../vendor/autoload.php';

define('ROOT_DIR', dirname(__DIR__));

list(, $class, $method) = explode('/', $_SERVER['REQUEST_URI']);
$file = ROOT_DIR . "/api/$class.php";
require_once $file;
echo (new $class)->$method();