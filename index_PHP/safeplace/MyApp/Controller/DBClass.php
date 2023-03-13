<?php

namespace MyApp\Controller;

use MyApp\Logger\LoggerInterface;
use PDO;

abstract class DBClass
{
    protected PDO $dbh;
    protected LoggerInterface $logger;

    public function __construct( PDO $dbh, LoggerInterface $logger)
    {
        // need to implement constructor
        $this->dbh = $dbh;
        $this->logger = $logger;
    }

    protected function queryFetchAll( $query, $queryParams ) {
        $this->logger->logEvent("query: ".$query, __FILE__, __LINE__, __FUNCTION__);
        $this->logger->logEvent("params: ".var_export($queryParams, true), __FILE__, __LINE__, __FUNCTION__);
        // подготовка запроса
        $sth = $this->dbh->prepare( $query );
        // выполнение запроса
        $sth->execute( $queryParams );
        return $sth->fetchAll();
    }
}