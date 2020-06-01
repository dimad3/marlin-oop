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
    //  echo 'getInstance - ';
    //  var_dump(self::$instance);
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

    // L#5 
    if(count($params)) { // if `$params` array not empty bind a value to a parameter
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
        // if execution failed - set Database object's `$error property` to TRUE
        $this->error = true;
    } else {
    
    /* Set the Database object's prperty `results`.
    All PDO "fetch" methods, requests an optional parameter called `$fetch_style` 
    that means the data structure which your entity will be returned, 
    when you use PDO::FETCH_OBJ it means that your entity will be an stdClass instance*/
    $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
    
    /* Set the Database object's prperty `count`.
    PDOStatement::rowCount — Returns the number of rows affected by the last SQL statement
    Returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement
    executed by the corresponding PDOStatement object.
    SELECT statement - some databases may return the number of rows returned by that statement.
    !!! However, this behaviour is not guaranteed for all databases and should NOT be relied on 
    for portable applications */
    $this->count = $this->query->rowCount();
    }
    // echo 'query - ';
    // var_dump($this);
    return $this;
}


// Returns the `error property` of `Database object`
// we can't access PRIVATE property `error` from external page to access it use PUBLIC `error method`
public function error()
{
    return $this->error;
}


// Returns the `results property` of `Database object`
// we can't access PRIVATE property `results` from external page to access it use PUBLIC `results method`
public function results()
{
    return $this->results;
}


// Returns the `count property` of `Database object`
// we can't access PRIVATE property `count` from external page to access it use PUBLIC `count method`
public function count()
{
    return $this->count;
}


public function get($table, $where = [])
// `$where array` contains 3 elements: 1) criteria's field name 2) operator 3) criteria's value
{
    return $this->action('SELECT *', $table, $where);
}


public function delete($table, $where = [])
// `$where array` contains 3 elements: 1) criteria's field name 2) operator 3) criteria's value
{
    return $this->action('DELETE', $table, $where);
}


public function action($action, $table, $where = [])
// `$where array` contains 3 elements: 1) criteria's field name 2) operator 3) criteria's value
{
    /* check whether the` $where array` contains 3 elements if it does NOT return FALSE
    if any element in the` $where array` is missing there no sense to execute a query 
    PHP count() Functionc - Return the number of elements in an array
    Parameter Values:
    array	Required. Specifies the array
    mode	Optional. Specifies the mode. Possible values:
            0 - Default. Does not count all elements of multidimensional arrays
            1 - Counts the array recursively (counts all the elements of multidimensional arrays) */
    if(count($where) === 3) {

        $operators = ['=', '>', '<', '>=', '<=']; // create the Indexed array of operators

        // assign the values from the `$where array` to variables
        $field = $where[0];     // criteria's field name
        $operator = $where[1];  // operator
        $value = $where[2];     // criteria's value

        /* Check whether the value of the `$operator variable` is in the `$operators array`.
        If the `$operators array` DOES contain the operator from the `$where array
        then execute the query. If it does NOT return FALSE
        The `in_array() function` searches an array for a specific value.
        Parameter Values:
        1) search	Required. Specifies the what to search for
        2) array	Required. Specifies the array to search
        3) type	    Optional. If this parameter is set to TRUE, the `in_array() function`
                    searches for the search-string and specific type in the array.
        Return Value:	Returns TRUE if the value is found in the array, or FALSE otherwise */
        if(in_array($operator, $operators)) {
            // set `$sql` string
            $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
            
            // run the `query method`
            $this->query($sql, [$value]);
            
            return $this;
        }
    }
}

}
