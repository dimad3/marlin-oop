<?php

class Token
{

//L9 4:15 - create new token string and add it as new element in $_SESSION[] array
public static function generate() 
{
    // set the `$keyName variable` by calling `get method` on `Config object`
    $keyName = Config::get('session.token_name');
    

    /* uniqid() - generates a unique ID based on the microtime (the current time in microseconds).
    Returns the unique identifier, as a string.
    Parametrs: 2 Optional parametrs.
    https://www.w3schools.com/php/func_misc_uniqid.asp */
    $random_string = uniqid();

    /* md5 — Calculate the md5 hash of a string
    Returns the calculated MD5 hash on success, or FALSE on failure
    Parametrs:
    1) string	Required. The string to be calculated
    2) raw	Optional.   Specifies hex or binary output format:
                        TRUE - Raw 16 character binary format
                        FALSE - Default. 32 character hex number
    https://www.w3schools.com/php/func_string_md5.asp */
    $token = md5($random_string);

    // call `put method` on `Session object`
    return Session::put($keyName, $token);
}


/*L#9 4:30 - checks whether `form's token value` exists in the `$_SESSION[] array`
Parametrs: string Required - token value to be checked
Returns true or false */
public static function check($token) 
{
    // set the `$keyName variable` by calling `get method` on `Config object`
    $keyName = Config::get('session.token_name');

    /* checks whether `token_name` exists in the `$_SESSION[] array` AND
    `form's token value` is equal to `token VALUE` in the `$_SESSION[] array` */
    if(Session::exists($keyName) && $token == Session::get($keyName)) {
        Session::delete($keyName);
        return true;
    }

    return false;
}

}