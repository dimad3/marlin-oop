<?php
require_once 'Database.php';

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

$users = Database::getinstance()->get('users', ['password', '=', '1234']);
var_dump($users->first());