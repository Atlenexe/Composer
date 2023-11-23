<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/vendor/autoload.php";

use Controllers\HomeController;
use Controllers\BlogController;
use Route\Router;

$route = new Router();
$route->defineRoute("GET", "/", HomeController::class, "index");
$route->defineRoute("GET", "/blog", BlogController::class, "index");
$route->checkRoute();
