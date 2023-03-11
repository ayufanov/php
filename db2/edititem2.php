<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check = 0;
    if (array_key_exists('tenant_id', $_POST)){
        $tenant = $_POST['tenant_id'];
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

        $mysqli->close();
    }


    if (array_key_exists('name', $_POST)){
        $name = $_POST['name'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `tenant` SET `name` = ? WHERE  tenant_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$name,$tenant);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if (array_key_exists('email', $_POST)){
        $email = $_POST['email'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `tenant` SET `email` = ? WHERE  tenant_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$email,$tenant);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if (array_key_exists('numb', $_POST)){
        $numb = $_POST['numb'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `tenant` SET `phonenum` = ? WHERE  tenant_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$numb,$tenant);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();

    }

    if (array_key_exists('birth_year', $_POST)){
        $birth_year = $_POST['birth_year'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `tenant` SET `birth_year` = ? WHERE  tenant_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$birth_year,$tenant);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if (array_key_exists('place_of_residence_id', $_POST)){
        $place_of_residence_id = $_POST['place_of_residence_id'];
        $mysqli = new mysqli('localhost', 'root', '9256', 'db2');
        if ($mysqli->connect_error) {
            print_r([]);
            die('ошибка подключения к БД');
        }
        $sql = "UPDATE `tenant` SET `place_of_residence_id` = ? WHERE  tenant_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si',$place_of_residence_id,$tenant);
        $stmt->execute()  or die('status: error'.'<br>'.'message: Failed to edit record');
        $check = 1;
        $mysqli->close();
    }

    if ($check == 1) {
        echo 'status: success' . '<br>' . 'ID: ' . $tenant;

    }else die('status: error'.'<br>'.'message: Failed to edit record');






} else echo '400';