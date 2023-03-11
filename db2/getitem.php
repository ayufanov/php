<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (array_key_exists('flat_id', $_GET)){
        $flat = $_GET['flat_id'];
        $flat = "$flat";
    }else die('400');

    $mysqli = new mysqli('localhost', 'root', '9256','db2');
    if ($mysqli->connect_error){
        print_r([]);
        die('ошибка подключения к БД');
    }
    if($result = $mysqli->query("
SELECT flat_id
FROM flat
WHERE flat_id = $flat
")) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($rows == []) {
            print_r([]);
            die();
        }

        $mysqli->close();
    }


    $mysqli = new mysqli('localhost', 'root', '9256','db2');
    if ($mysqli->connect_error){
        print_r([]);
        die('ошибка подключения  к БД');
    }
    if($result = $mysqli->query("
SELECT flat_id, square, ownername, city, address, rooms_num
FROM flat 
LEFT JOIN owner ON owner_id = owner_id1 
LEFT JOIN houses ON house_id = house_id1
WHERE  `flat_id` = $flat")){
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo '<pre>';
        print_r($rows);
        echo '</pre>';
        $result->close();
    }else{
        print_r([]);
        die('400');
    }
    if($result = $mysqli->query("
SELECT name, tenant_id
FROM flat 
LEFT JOIN  intermediate_table ON flat_id = flat_id1
LEFT JOIN tenant ON tenant_id = tenant_id1 
WHERE  `flat_id` = $flat")){
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo '<pre>';
        print_r($rows);
        echo '</pre>';
        $result->close();
    }




    $mysqli->close();
}else echo '400';
