<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (array_key_exists('name', $_POST)) {
        $name = $_POST['name'];
    } else die('400, недостаточно данных');

    if (array_key_exists('email', $_POST)) {
        $email = $_POST['email'];
    } else die('400, недостаточно данных');

    if (array_key_exists('numb', $_POST)) {
        $numb = $_POST['numb'];
    } else die('400, недостаточно данных');

    if (array_key_exists('birth_year', $_POST)) {
        $birth_year = $_POST['birth_year'];
    } else die('400, недостаточно данных');



    $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
    if ($mysqli->connect_error) {
        print_r([]);
        die('ошибка подключения  к БД');
    }
    $stmt = $mysqli->prepare("INSERT INTO `tenant`( `name`, `email`, `phonenum`, `birth_year`) VALUES (?,?,?,?)");
    $stmt->bind_param('sssd', $name, $email, $numb, $birth_year);
    $stmt->execute();

    if ($mysqli->insert_id == 0) {
        echo "status: error" . '<br>' . 'message: Failed to add record';
    } else echo 'status: success' . '<br>' . 'id:' . "$mysqli->insert_id";

    $mysqli->close();
} else echo '400';