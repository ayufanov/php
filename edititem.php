<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check = 0;
    if (array_key_exists('flat_id', $_POST)){
        $flat = $_POST['flat_id'];
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
            die('status: error' . '<br>' . 'message: Failed to edit record');
        }

        $mysqli->close();
    }


    if (array_key_exists('square', $_POST)){
        $square = $_POST['square'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `flat` SET `square` = ? WHERE  flat_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$square,$flat);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if (array_key_exists('owner_id', $_POST)){
        $owner = $_POST['owner_id'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `flat` SET `owner_id` = ? WHERE  flat_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$owner,$flat);
        $stmt->execute() or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if (array_key_exists('house_id', $_POST)){
        $house = $_POST['house_id'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения  к БД');
        }
        $sql = "UPDATE `flat` SET `house_id` = ? WHERE  flat_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$house, $flat);
        $stmt->execute() or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();

    }

    if (array_key_exists('rooms_num', $_POST)){
        $rooms = $_POST['rooms_num'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `flat` SET `rooms_num` = ? WHERE  flat_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$rooms, $flat);
        $stmt->execute() or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }
    if ($check == 1) {
        echo 'status: success' . '<br>' . 'ID: ' . $flat;

    }else die('status: error'.'<br>'.'message: Failed to edit record');


} else echo '400';