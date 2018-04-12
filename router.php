<?php
header("Access-Control-Allow-Origin: *");
require_once 'config.php';

// className
$uriPathInfo = $_SERVER['PATH_INFO'];
$path = explode('/', $uriPathInfo);
$requestClass = $path[1];
$requestClass = preg_replace('#[^0-9a-zA-Z]#', '', $requestClass);
$className = ucfirst(strtolower($requestClass));

// load class
require_once 'class/' . $className . '.php';

// set connection for class
$className::setDb(new DBmysql());

// params
$pathId = isset($path[2]) ? $path[2] : null;

// load restpoint
include_once 'restEndPoints/' . $className . '.php';

header('Content-Type: application/json');
echo json_encode($response);