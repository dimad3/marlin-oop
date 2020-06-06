<?php

class Input
{
    // L#8 04:00
    // check whether the form was submited
    // Returns TRUE if it was and FALSE if it was NOT
    public static function exists($type = 'post') 
    {
    /* L#8
    The switch-case statement differs from the if-elseif-else statement in one important way. 
    The switch statement executes line by line (i.e. statement by statement) and once PHP 
    finds a case statement that evaluates to TRUE, it's not only executes the code corresponding 
    to that case statement, but also executes all the subsequent case statements till the end 
    of the switch block automatically.

    To prevent this add a `BREAK` statement to the end of each case block.
    The 'BREAK' statement tells PHP to break out of the switch-case statement block 
    once it executes the code associated with the first true case.
    */
    switch ($type) {
        /*
        The value of the `$type variable` is compared with the values for each case in the structure.
        If there is a match, the block of code associated with that `case` is executed.
        */
        case 'post':
            return (!empty($_POST)) ? true : false; // #isset (see forum)
        case 'get':
            return (!empty($_GET)) ? true : false;
        
        // The default statement is used if no match is found
        default:
            return false;
        
        // Use break to prevent the code from running into the next case automatically
        break;  // (see forum)
    }
}


// L#8 04:40
// returns string to provide it to the corresponding form's field
// $input_value = string = the name of the form's field = the key of the one element in the $_POST array
public static function get($field_name) 
{
    // check whether the form was submited using the `POST method`
    if(isset($_POST[$field_name])) {
        /* if it was - returns the cooresponding value of `$field_name key` 
        in the `$_POST array` (as string)
        */
        return $_POST[$field_name];
    } else if(isset($_GET[$field_name])) {
        return $_GET[$field_name];
    }

    return '';
}

}