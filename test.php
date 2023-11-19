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

// addUser('meower');
// addPlaylist(1, 'paylist', './db/songs/pictures/test_picture.png');
// savePlaylistForUser(1, 1);


addSongToPlaylist(1, 1);
// removeSongFromPlaylist(1, 1);
