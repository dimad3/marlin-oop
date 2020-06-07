<?php
require_once 'classes/Session.php';
session_start();

// get msg from the $_SESSION[] array
echo Session::flash('success');
