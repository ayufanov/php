<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $mysqli = new mysqli('localhost', 'root', '9256','db2');
        if ($mysqli->connect_error){
            print_r([]);
            die('ошибка подключения  к БД');
        }
        if($result = $mysqli->query("
SELECT flat_id, square, ownername, city, address, rooms_num
FROM flat 
LEFT JOIN owner ON owner_id = owner_id1 
LEFT JOIN houses ON house_id = house_id1 ")){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            echo '<pre>';
            print_r($rows);
            echo '</pre>';
            $result->close();
        }else{
            print_r([]);
        }
        $mysqli->close();
    }else echo '400';
