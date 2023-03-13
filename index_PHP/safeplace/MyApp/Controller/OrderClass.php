<?php

namespace MyApp\Controller;

use MyApp\Controller\DBClass;
use PDO;
use Exception;

class OrderClass extends DBClass
{
    public function info( int $orderId ) {
        // implement delete
        throw new Exception('info not implemented yet');
    }

    /**
     * Получение списка приказов
     */
    public function list(  ) {
        // implement list
        $this->logger->logEvent('inside list', __FILE__, __LINE__, __FUNCTION__);
        $query = "SELECT `order`.`oid`, `order`.`order_num`, `order`.`order_date`, 
            CONCAT(`client`.`lastname`, ' ', `client`.`firstname`) as client
        FROM `order`
        LEFT JOIN `client` ON `order`.`client_id`=`client`.`ID`
        WHERE 1";
        $queryParams = []; // TODO: no params yet. Implement.
        $data = $this->queryFetchAll($query, $queryParams);
//        print_r($data);
        return json_encode($data);
    }

    public function add(  ) { //array $data
        // implement add method
        $data = $_POST; // TODO: filter!!!!
        throw new Exception('add not implemented yet');
    }

    public function edit(  int $orderId , array $data ) {
        // implement edit
        throw new Exception('edit not implemented yet');
    }

    public function delete(  int $orderId  ) {
        // implement delete
        throw new Exception('delete not implemented yet');
    }

}

//echo "Hello this is class order";