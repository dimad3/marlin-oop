<?php
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

// Redirect::to('test.php');
// Redirect::to(404);

echo 123;