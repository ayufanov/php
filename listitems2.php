<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $mysqli = new mysqli('localhost', 'root', '9256','db2');
        if ($mysqli->connect_error){
            print_r([]);
            die('ошибка подключения к БД');
        }
        if($result = $mysqli->query("
SELECT tenant_id, name, email, phonenum, birth_year,residence_addr
FROM tenant 
LEFT JOIN  residence ON place_of_residence_id = residence_id")){
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
