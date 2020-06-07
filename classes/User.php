<?php
// L#10
class User 
{
    
private $db;

public function __construct($user = null) {
    $this->db = Database::getInstance();
}

// add new user to db
// Parameters: array    Required. Array of tablea's fields
public function create($fields = []) {
    $this->db->insert('users', $fields);
}

}