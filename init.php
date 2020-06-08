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
require_once 'classes/User.php';
require_once 'classes/Redirect.php';

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
