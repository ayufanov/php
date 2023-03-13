<?php

require_once '../safeplace/settings.inc.php';
require_once  MODULES_DIR.'autoloader.php';

//require_once '../safeplace/MyApp/Controller/DBClass.php';
use MyApp\Controller\OrderClass;
use MyApp\Logger\LoggerBuffer;

echo '1---<br>';
$dbh = new PDO('mysql:host=localhost;dbname=cr3example;charset=utf8', 'cr3', '1111');
$logger = new LoggerBuffer(1);
$class = new OrderClass($dbh, $logger);
echo '2---<br>';
$controller = 'MyApp\Controller\OrderClass';
//require_once MODULES_DIR.'MyApp\Controller\OrderClass.php';
$class = new $controller($dbh, $logger);
echo '3---<br>';