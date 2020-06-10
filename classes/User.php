<?php
// L#10
class User 
{
    
private $db, $data /*stdClass Object*/, $sessionKey;

public function __construct($user = null) 
{
    $this->db = Database::getInstance();
    $this->sessionKey = Config::get('session.userId');    // set `$sessionKey property` of the `User Object`
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
    if($email) {   // if(!empty($email))
                    // In short, it makes the opposite of the empty() function! + forum
                    // https://stackoverflow.com/questions/11012822/what-does-if-variablename-do-in-php
        
                    // find the record by email in db and set `$data property` of the `User Object` as stdClass Object
        $user = $this->find($email);
        // Retrns TRUE or FALSE
        
        if($user) { // if($user == TRUE)
            // set `$hash variable` assigning the user's password value from table `users` 
            $hash = $this->data()->password;    // 
            
            // $password - 2-nd parameter - form's field `password` value
            if(password_verify($password, $hash)) {
                // add new element in $_SEESION[] as userId
                Session::put($this->sessionKey, $this->data()->id);

            }
            return true;
        }
    }
    return false;

}


// L#13 - set `$data property` of the `User Object` as stdClass Object
// Retrns TRUE or FALSE
public function find($value = null)
{
    //
    $this->data = $this->db->get('users', ['email', '=', $value])->first();
    // Returns stdClass Object

    if($this->data) {   // if (isset($data))
        return true;
    }
    return false;
}


// L#13
// Returns the `$data property` of `User object` as stdClass Object
public function data()
{
    return $this->data;
}

}