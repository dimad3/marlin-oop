<?php
// L#10
class User 
{
    
private $db, $data /*stdClass Object*/, $sessionKey /*string*/, $isLoggedIn /*bool*/;

public function __construct($user = null) 
{
    $this->db = Database::getInstance();
    
    // set `$sessionKey property` of the `User Object`
    $this->sessionKey = Config::get('session.userId');
    
    // check whether `$user parameter` is null (not provided)
    if(!$user) {    // = if(!isset($user)) { ...
        
        // IF `$user parameter` IS NULL then:
        // check whether element with provided KEY exists in the $_SESSION[] array
        if(Session::exists($this->sessionKey)) {    // returns boolean
            
            // set `$userId variable` by assigning `userId VALUE` from $_SEESION - returns string 
            $userIdVal = Session::get($this->sessionKey); 

            // checks whether `find method` on `User object` returns true
            if($this->find($userIdVal)) {
                $this->isLoggedIn = true;  // set `$isLoggedIn property` of the `User Object`
            }
        }
    } else {
        // IF `$user parameter` IS NOT NULL then:
        $this->find($user); // where do we need it till L#15?
    }

}

// add new user to db
// Parameters: array    Required. Array of table's fields
public function create($fields = []) 
{
    $this->db->insert('users', $fields);
}


/**
 * L#13 - verifies provided values of form's fields and add new user element in the $_SEESION[] array
 * @param string|null $email
 * @param string|null $password
 * @param bool $remember
 * @return bool
 */
public function login($email = null, string $password = null)
{
    if($email) {   // if(isset($email))
        
        // find the record by email in db and set `$data property` of the `User Object` as stdClass Object
        $user = $this->find($email);
        // Retrns TRUE or FALSE
        
        // checks whether provided email exists in db's table
        if($user) { // if($user == TRUE)
            
            // if $user == TRUE then:
            // set `$hash variable` assigning the user's password value from table `users` 
            $hash = $this->data()->password;    // returns hash string
            
            // $password - 2-nd parameter - form's field `password` value
            if(password_verify($password, $hash)) {
                // add new element in $_SEESION[] as userId
                Session::put($this->sessionKey, $this->data()->id);
                return true;
            }
        }
    }
    return false;

}


// L#13 - set `$data property` of the `User Object` as stdClass Object
// and
// Retrns TRUE or FALSE
public function find($value = null)
{
    if(is_numeric($value)) {
        // find user by id
        $this->data = $this->db->get('users', ['id', '=', $value])->first();
        // Returns stdClass Object
    } else {
        // find user by email
        $this->data = $this->db->get('users', ['email', '=', $value])->first();
        // Returns stdClass Object
    }

    if($this->data) {   // if (isset($data))
        return true;
    }
    return false;
}


// L#13 - Returns the `$data property` of `User object` as stdClass Object
public function data()
{
    return $this->data;
}


// L#14 - Returns the `$isLoggedIn property` of `User object` as Bolean
public function isLoggedIn() {
    return $this->isLoggedIn;
}

}