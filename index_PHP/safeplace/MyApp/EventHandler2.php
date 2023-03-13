<?php

namespace MyApp;

use MyApp\Controller;
use MyApp\Logger\LoggerInterface;
use PDO;
use Exception;
//use MyApp\Controller\OrderClass;

class EventHandler2
{
    private string $page;
    private PDO $dbh;
    protected LoggerInterface $logger;
    protected array $handler;

    public function __construct(array $dbSettings, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $page = array_key_exists('page', $_GET) ? $_GET['page'] : 'default';
        // инициализация базы
        $this->initDB( $dbSettings['connectionString'], $dbSettings['dbUser'], $dbSettings['dbPwd'] );
        $this->setPage($page);
    }

    private function setPage( string $page ) {
        if( !empty($page) ) {
            $this->page = $page;
            $query = 'SELECT * FROM `system_pages` WHERE `page` LIKE ?';
            $this->logger->logEvent('query: '.$query . ' | page = '.$this->page, __FILE__, __LINE__, __FUNCTION__);
            $sth = $this->dbh->prepare( $query );
            // выполнение запроса
            $sth->execute( [$this->page] );
            $res = $sth->fetchAll();
            if( !empty($res) && count($res)==1 ) {
                $this->handler = $res[0];
            }
        }
        if( empty( $this->handler ) ) {
            $this->page = 'default';
            $this->handler = [
                'page' => 'default',
                'description' => 'Действие по-умолчанию',
                'controller' => 'OrderClass',
                'handler' => 'list'
            ];
        }
        $this->logger->logEvent('handler: '.var_export($this->handler, true), __FILE__, __LINE__, __FUNCTION__);
    }

    private function createController()
    {
        // указываем полный name
        $controller = 'MyApp\Controller\\'.$this->handler['controller'];
        $this->logger->logEvent('going to create '.$controller, __FILE__, __LINE__, __FUNCTION__);
        $params = [
            $this->dbh,
            $this->logger
        ];
        return new $controller(...$params);
//        return new $controller($this->dbh, $this->logger);
    }

    private function getHandlerFunction()
    {
        return $this->handler['handler'];
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
            // вариант с хранением контролееров в базе
            $controller = $this->createController();
            $handler = $this->getHandlerFunction();
            echo $controller->$handler();
        }
        catch (Exception $e) {
            $this->logger->logEvent($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
            echo json_encode([]);
        }
    }

}