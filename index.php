<?php
require_once 'init.php';
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

// $newuser = Database::getinstance()->insert('users', [
//     'username' => 'User7',
//     'password' => 'user7'
// ]);
// var_dump($newuser);

// $users = Database::getinstance()->delete('users', ['password', '=', 's']);

// $updateduser = Database::getinstance()->update('users', 6, [
//     'username' => 'User3',
//     'password' => 'user33'
//     ]);
// var_dump($updateduser);

// $users = Database::getinstance()->get('users', ['password', '=', '1234']);
// var_dump($users->first());


// L#12 - Redirect
// Redirect::to('test.php');
// Redirect::to(404);


// L#14 - User Login
// var_dump(Session::get(Config::get('session.userKey')));
// var_dump($_SESSION);


// L#15-17 - Проверка авторизации + remember me
$user = new User; // WITHOUT parameter (see constructor)!

// checks whether `$isLoggedIn property` of `User object` is true
if ($user->isLoggedIn()) {
    echo "Hi, {$user->data()->username}";
    echo "<p><a href='logout.php'>Log Out</a></p>";
} else {
    echo "<p><a href='login.php'>Log In</a> or <a href='register.php'>Sign In</a></p>";
}
// var_dump($_SESSION);
// echo var_dump($_COOKIE);

// move_uploaded_file(123123123, 'uploads/image.jpg');



// $user = new User;
// $user->login('rahim@marlindev.ru', '123123');
