<?php

class Database {
    private static $instance = null; // by default $instance is null
    private $pdo;

    private function __construct() {
        try {
            // $this->pdo = new PDO("mysql:host=" . Config::get('mysql.host') . ";dbname=" . 
            // Config::get('mysql.database'), 
            // Config::get('mysql.username'), 
            // Config::get('mysql.password'));
            
            // $this->$pdo = new PDO(dsn: 'mysql:host=localhost; dbname=ijdb'; username: 'ijdbuser', passwd: 'mypassword');
            $pdo = new PDO('mysql:host=localhost; dbname=test; charset=utf8',
            'root',
            '');
            $this->pdo = $pdo;
            echo 'ok';
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance() {
        // if $instance do not exist, create it
        if(!isset(self::$instance)) {
            self::$instance = new Database;
        }

        return self::$instance;
    }
}
