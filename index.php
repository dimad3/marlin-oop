<?php
session_start(); // L#9 9:08 - creates a session or resumes the current one
// Create an associative array $_SESSION[] containing session variables available to the current script

//var_dump($_SESSION['token']);die;
require_once 'classes/Database.php';
require_once 'classes/Config.php';
require_once 'classes/Input.php';
require_once 'classes/Validate.php';
require_once 'classes/Token.php';
require_once 'classes/Session.php';


// var_dump($GLOBALS); die;
// add our own element in the $GLOBALS array
$GLOBALS['config'] = [ // in init.php
    'mysql' => [
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'database'  => 'test',
        'something' => [
            'no'    => [
                'foo'   => [
                    'bar'   => 'baz'
                ]
            ]
        ]
    ],

    'session' => [
        'token_name' => 'token' // L#9 - new element's KEY name in the $_SESSION[] array
    ]
];

// echo Config::get('mysql.something.no.foo.bar'); // baz

// $users = Database::getinstance()->query("SELECT * FROM `users` WHERE username = IN (?,?)", ['John Doe', 'Jane Koe']);

// $users = Database::getinstance()->get('users', ['password', '=', '1234']);

// var_dump($users);

// if($users->error()) {
//     echo 'we have an error';
// } else {
//     foreach($users->results() as $user) {
//         echo $user->username . '</br>';
//     }
// }

// $users = Database::getinstance()->delete('users', ['password', '=', 's']);

// $newuser = Database::getinstance()->insert('users1', [
//     'username' => 'User1',
//     'password' => 'user'
//     ]);
// var_dump($newuser);

// $updateduser = Database::getinstance()->update('users', 6, [
//     'username' => 'User3',
//     'password' => 'user33'
//     ]);
// var_dump($updateduser);

// $users = Database::getinstance()->get('users', ['password', '=', '1234']);
// var_dump($users->first());

// L#8
// Input::exists() - check whether the form was submited (see forum)
// Returns TRUE if it was and FALSE if it was NOT
if (Input::exists()) { // true or false
    
    // L#9 05:10 - get a VALUE of a form's field after the form was submited
    // 'token' - the name of the form's field from which to get the VALUE
    $fieldValue = Input::get('token');

    // checks whether `form's token value` exists in the `$_SESSION[] array`
    $tokenExists = Token::check($fieldValue); // true or false
    
    if ($tokenExists == true) { // L#9 
    
        $validate = new Validate();

        $validation = $validate->check(
            $_POST,
            [
                'username' => [                 // field name
                    'required'  => true,
                    'min'       => 2,
                    'max'       => 9,
                    'unique'    => 'users'      // the name of the table
                ],
                
                'password' => [                 // field name
                    'required'  => true,
                    'min'       => 3
                ],

                'password_again' => [           // field name
                    'required'  => true,
                    'matches'   => 'password' // the name of the field to compare with
                ]
            ]
        );

        // $validation = Validate object
        // check whether `$passed property` of `Validate object` is TRUE
        if ($validation->passed()) {
            echo 'passed';
        } else {
            foreach($validation->errors() as $error) {
                // $validation->errors() - ARRAY - `$errors property` of `Validate object`
                // $error - VALUE of each error
                echo $error . '</br>';
            }
        }
    }

}
// var_dump(Token::generate());

?>

<form action='' method='post'>
    <div class='field'>
        <label for='username'>Username</label>
        <input type='text' name='username' value='<?php echo Input::get('username') ?>'>
    </div>

    <div class='field'>
        <label for='password'>Password</label>
        <input type='text' name='password'>
    </div>

    <div class='field'>
        <label for='password_again'>Password again</label>
        <input type='text' name='password_again'>
    </div>

    <input type='text' name='token' value=
    '<?php 
        // call generate method` on Token object` and set new token value to this field
        echo Token::generate();
    ?>'>
    <!-- Most of the people do it wrong, by adding `token stored in the session`. That is not 
    the correct method, use the `token variable` instead of `token stored in the session.` 
    https://codingcyber.org/secure-php-forms-csrf-tokens-7286/ -->

    <div class='field'>
        <button type='submit'>Submit</button>
    </div>
</form>
