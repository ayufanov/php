<?php


if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    if (array_key_exists('tenant_id', $_GET)){
        $tenant = $_GET['tenant_id'];
    }else die('400');

    $mysqli = new mysqli('localhost', 'root', '9256','db2');
    if ($mysqli->connect_error){
        print_r([]);
        die('ошибка подключения к БД');
    }
    if($result = $mysqli->query("
SELECT tenant_id
FROM tenant
WHERE tenant_id = $tenant
")) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($rows == []) {
            die('status: error' . '<br>' . 'message: Failed to edit record');
        }

    }

    $sql = "DELETE FROM tenant WHERE `tenant_id` = $tenant";

    if($mysqli->query($sql)== TRUE){
        echo '"status": "success"';
    }else echo '"status": "error",'.'<br>'.'"message": "Failed to delete record"';







} else echo '400';