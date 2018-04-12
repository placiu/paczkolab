<?php
header("Access-Control-Allow-Origin: *");
require_once 'config.php';

// className
$uriPathInfo = $_SERVER['PATH_INFO'];
$path = explode('/', $uriPathInfo);
$requestClass = $path[1];
$requestClass = preg_replace('#[^0-9a-zA-Z]#', '', $requestClass);
$className = ucfirst(strtolower($requestClass));

<<<<<<< HEAD
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
=======

$response = [];
//connect to DB
try {
    $conn = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8"
        , DB_LOGIN, DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    $response = ['error' => 'DB Connection error: '.$e->getMessage()];
}

######### Dynamic load php class file depend on request #########
//parsing url
//if request URI is rest.php/book/1
//we will parse part book/1 and explode it
//to get name of class (book) and optional id from db (1)
$uriPathInfo = $_SERVER['PATH_INFO'];
//explode path info
$path = explode('/', $uriPathInfo);
$requestClass = $path[1];

//load class file
$requestClass = preg_replace('#[^0-9a-zA-Z]#', '', $requestClass);//remove all non alfanum chars from request
$className = ucfirst(strtolower($requestClass));

$classFile = __DIR__.'/class/'.$className.'.php';
require_once $classFile;

######### END DYNAMIC LOAD #########

$pathId = isset($path[2]) ? $path[2] : null;

if (!isset($response['error'])) {//process request if no db error
    include_once __DIR__.'/restEndpoints/'.$className.'.php';
}

header('Content-Type: application/json');//return json header

if (isset($response['error'])) {
    header("HTTP/1.0 400 Bad Request");//return proper http code if error
}

echo json_encode($response);


>>>>>>> fb8b2343b4074fcda77daf8d27319a21915a5229
