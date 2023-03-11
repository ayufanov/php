<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (array_key_exists('flat_id', $_POST)) {
        $flat = $_POST['flat_id'];
    } else die('400, недостаточно данных');

    if (array_key_exists('tenant_id', $_POST)) {
        $tenant = $_POST['tenant_id'];
    } else die('400, недостаточно данных');

    $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
    if ($mysqli->connect_error) {
        print_r([]);
        die('ошибка подключения к БД');
    }


    $stmt = $mysqli->prepare("INSERT INTO `intermediate_table`(`flat_id1`, `tenant_id1`) VALUES (?,?)");
    $stmt->bind_param('ss', $flat, $tenant);
    $stmt->execute();

    if ($mysqli->insert_id == 0) {
        echo "status: error" . '<br>' . 'message: Failed to add record';
    } else echo 'status: success' ;
    $mysqli->close();


} else echo '400';