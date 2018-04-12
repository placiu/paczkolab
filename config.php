<?php
//Load dependency classes

require(__DIR__ . '/class/interface/Database.php');
require(__DIR__ . '/class/interface/Action.php');
require(__DIR__ . '/class/database/DBmysql.php');

//Set DB connection
define('DB_SERVER_NAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'coderslab');
define('DB_BASE_NAME', 'paczkolab');