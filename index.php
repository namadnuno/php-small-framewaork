<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Acme\Controllers\HomeController;
use Acme\Route;

require __DIR__ . '/vendor/autoload.php';

$route = Route::defaultRoute();
$route->execute();
