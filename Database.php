<?php

class Database {

// L#3
private static $instance = null; // by default $instance is null
private $pdo, $query, $error = false, $results, $count;

private function __construct() {
    try {
        $this->pdo = new PDO('mysql:host=localhost; dbname=test; charset=utf8',
        'root',
        '');
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


// L#4
public function query($sql, $params = [])
{
    // Set $error property to FALSE before running the query (L#4 8:00)
    $this->error = false;
    
    /* Call the `prepare method` of class PDO object (pdo # $pdo !!!), passing it our SQL string
    as an argument. This sends the query to the MySQL server, asking it to prepare to run the query.
    MySQL can’t run it yet—there’s no value for the `$parameters`.
    PDO::prepare — Prepares a statement for execution and returns a statement object.
    calling `PDO::prepare()` and `PDOStatement::execute()` helps to prevent
    SQL injection attacks by eliminating the need to manually quote and escape the parameters */
    $this->query = $this->pdo->prepare($sql);
    /* $sql - must be a valid SQL statement template for the target database server
    
    If the database server successfully prepares the statement, 
    `PDO::prepare()` returns a `PDOStatement object`.
    If the database server cannot successfully prepare the statement,
    `PDO::prepare()` returns FALSE or emits `PDOException` (depending on error handling). */

    // $this->query->execute();
    // return $this->query->fetchAll(PDO::FETCH_OBJ);
    var_dump($params); die;

    // L#5 
    if(count($params)) {
        // if `$params` array not empty bind a value to a parameter
        // before running the loop - set parameter identifier equal to 1
        $i = 1;
        foreach($params as $param) {
            /* PDOStatement::bindValue — Binds a value to a parameter
            Binds a value to a question mark placeholder in the SQL statement 
            that was used to prepare the statement 
            1) `$i` - parameter identifier - For a prepared statement using question mark placeholders, 
            this will be the 1-indexed position of the parameter.
            2) The value to bind to the parameter */
            $this->query->bindValue($i, $param);
            $i++; // increase parameter identifier by 1
        }
    }

    /* PDOStatement::execute — Executes a prepared statement.
    Returns TRUE on success or FALSE on failure.*/
    if(!$this->query->execute()) {
        $this->error = true;
    } else {
    /* All PDO "fetch" methods, requests an optional parameter called `$fetch_style` 
    that means the data structure which your entity will be returned, 
    when you use PDO::FETCH_OBJ it means that your entity will be an stdClass instance*/
    $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
    $this->count = $this->query->rowCount();
    }

    return $this;
}


public function error()
{
    return $this->error;
}


public function results()
{
    return $this->results;
}


public function count()
{
    return $this->count;
}

}
