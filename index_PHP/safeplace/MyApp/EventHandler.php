<?php

namespace MyApp;

use MyApp\Controller;
use MyApp\Logger\LoggerInterface;
use PDO;
use Exception;

class EventHandler
{
    private string $page;
    private PDO $dbh;
    protected LoggerInterface $logger;

    public function __construct(array $dbSettings, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->page = array_key_exists('page', $_GET) ? $_GET['page'] : 'default';
        // инициализация базы
        $this->initDB( $dbSettings['connectionString'], $dbSettings['dbUser'], $dbSettings['dbPwd'] );
    }

    private function initDB( string $connectionString, string $dbUser, string $dbPwd )
    {
        // создание подключения через connection_string с указанием типа базы
        $this->dbh = new PDO( $connectionString, $dbUser, $dbPwd );
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->logger->logEvent('Connected to DB!', __FILE__, __LINE__, __FUNCTION__);
    }

    /**
     * call handler to process request
     */
    public function run()
    {
        try {
            $this->logger->logEvent('curpage: '.$this->page, __FILE__, __LINE__, __FUNCTION__);
            //простой вариант со switch
            switch ( $this->page ) {
                case 'listorders':
                    // do smth
                    $orders = new Controller\OrderClass( $this->dbh, $this->logger );
                    echo $orders->list();
                    break;
                case 'orderinfo':
                    // do smth
                    break;
                // ... more actions
                default:
                    // default page
                    echo "default action!!!!";
                    break;
            }
        }
        catch (Exception $e) {
            $this->logger->logEvent($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
            echo json_encode([]);
        }
    }

}