<?php
require_once 'Database.php';
//Database::getinstance();

$users = Database::getinstance()->query
("SELECT * FROM `users` WHERE username = IN (?,?)", ['John Doe', 'Jane Koe']);

var_dump($users);
