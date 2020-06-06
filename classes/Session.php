<?php

class Session
{

/* L#9 4:00 - add new element in the $_SESSION[] array
Parametrs:
1) $keyName string - new element's KEY name
2) $value - new element's VALUE for corresponding new key
*/
public static function put($keyName, $value)
{
    return $_SESSION[$keyName] = $value;
}


/* L#9 4:00 - checks whether element exists in the $_SESSION[] array
Parametrs: string Required - key name to be checked in the $_SESSION[] array
Returns TRUE or FALSE */
public static function exists($keyName) {
    return (isset($_SESSION[$keyName])) ? true : false;
}


/* L#9 4:00 - delete element from $_SESSION[] array
Parametrs: string Required - key name to be deleted from the $_SESSION[] array */
public static function delete($keyName) 
{
    if(self::exists($keyName)) {
        unset($_SESSION[$keyName]);
    }
}


/* L#9 4:00 - find element in the $_SESSION[] array
Parametrs: string Required - key name to be found in the $_SESSION[] array
Returns elements key name (as string) */
public static function get($keyName) 
{
    return $_SESSION[$keyName];
}


public static function flash($name, $string = '') 
{
    if(self::exists($name) && self::get($name) !== '') {
        $session = self::get($name);
        self::delete($name);
        return $session;
    } else {
        self::put($name, $string);
    }
}

}