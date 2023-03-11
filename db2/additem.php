<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (array_key_exists('square', $_POST)){
        $square = $_POST['square'];
    }else die('400, недостаточно данных');

    if (array_key_exists('owner_id', $_POST)){
        $owner = $_POST['owner_id'];
    }else die('400, недостаточно данных');

    if (array_key_exists('house_id', $_POST)){
        $house = $_POST['house_id'];
    }else die('400, недостаточно данных');

    if (array_key_exists('rooms_num', $_POST)){
        $rooms = $_POST['rooms_num'];
    }else die('400, недостаточно данных');


    $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
    if ($mysqli->connect_error) {
        print_r([]);
        die('ошибка подключения к БД');
    }
    $sql = "INSERT INTO `flat`( `square`, `owner_id`, `house_id`, `rooms_num`) VALUES (?,?,?,?) ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssd',$square, $owner, $house, $rooms );
    $stmt->execute();

    if ($mysqli->insert_id == 0){
        echo "status: error".'<br>'.'message: Failed to add record';
    }else echo 'status: success'.'<br>'.'id:'."$mysqli->insert_id";

    $mysqli->close();
} else echo '400';