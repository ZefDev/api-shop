<?php

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/Components/Autoloader.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Allow-Headers: Content-Type");

Autoloader::register();

use Components\Router;

$router = new Router();
$router->run();