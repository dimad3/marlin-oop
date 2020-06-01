<?php
require_once 'Database.php';
//Database::getinstance();

$users = Database::getinstance()->get('users', ['password', '=', '1234']);

var_dump($users);

//if($users == false) {
if($users->error()) {
    echo 'we have an error';
} else {
    foreach($users->results() as $user) {
        echo $user->username . '</br>';
    }
}
