<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['user-id'] = 1;

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'you_cannot_spotify';

function create_conn(): mysqli
{
    global $servername, $username, $password, $dbname;
    return new mysqli($servername, $username, $password, $dbname);
}
