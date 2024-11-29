<?php

use Teste\GvdSolucoes\Structure\Connection\ConnectionCreator;
use Teste\GvdSolucoes\Controller\{
  Controller,
  Error404Controller
};

require_once __DIR__ . "/../vendor/autoload.php";

$routes = require_once __DIR__ . "/../config/routes.php";

$pathInfo = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (str_ends_with($pathInfo, "/") && $pathInfo !== "/") $pathInfo = substr($pathInfo, 0, -1);
$httpMethod = $_SERVER["REQUEST_METHOD"];

session_start();

$key = "{$httpMethod}|{$pathInfo}";

if (array_key_exists($key, $routes)) {
  [$controllerClass, $action] = $routes["{$httpMethod}|{$pathInfo}"];
  $controller = new $controllerClass();
} else {
  $controller = new Error404Controller();
}

$action ??= "index";

$pdo = ConnectionCreator::connect();
/** @var Controller $controller */
$controller->$action($pdo);
