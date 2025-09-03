<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/routes.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/service.php");

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$reqMethod = strtolower($_SERVER['REQUEST_METHOD']);

$controllerName = Service::getController($routes, $reqMethod, $path);


$controllerFileName = strtolower($controllerName . ".php");


$controllerPath = $_SERVER['DOCUMENT_ROOT'] . "/controllers/$controllerFileName";

if (file_exists($controllerPath)) {
    // echo $controllerPath;
    require_once($controllerPath);
}

$controller = new $controllerName($reqMethod);
$controller->start($path);
