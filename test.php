<?php

require_once 'php/db/users.php';
require_once 'php/db/playlists.php';
require_once 'php/db/songs.php';
require_once 'php/db/saved.php';
require_once 'php/db/contains.php';

$conn;
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'you_cannot_spotify';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed \'' . $conn->connect_error . '\'');
}

if ($_POST[''])

// if (singup('meower', 'meomeo', 'meow@gmeow.com')) {
//     echo json_encode(['result' => 'success']);
// } else {
//     echo json_encode(['result' => 'fail']);
// }

// $user = login('meowe1', 'meomeo', 'meow@gmeow.com');
// if (!!$user) {
//     echo $user;
// } else {
//     echo json_encode(['result' => 'fail']);
// }