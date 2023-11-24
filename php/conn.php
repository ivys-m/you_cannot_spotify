<?php
session_start();

$_SESSION['user-id'] = 1;

$conn;
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'you_cannot_spotify';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed \'' . $conn->connect_error . '\'');
}