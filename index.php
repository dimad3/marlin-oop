<?php
require_once 'classes/Database.php';
require_once 'classes/Config.php';
require_once 'classes/Input.php';
require_once 'classes/Validate.php';


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
                'matches'       => 'password' // the name of the field to compare with
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

    <div class='field'>
        <button type='submit'>Submit</button>
    </div>
</form>
