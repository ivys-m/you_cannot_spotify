<?php

require('php/users.php');
require('php/playlists.php');
require('php/songs.php');

$conn;
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'you_cannot_spotify';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed \'' . $conn->connect_error . '\'');
}

// echo 'user: ';
// echo addUser('new-user');
// echo ' - playlist: ';
// echo addPlaylist(1, 'new-playlist');
// echo ' - playlist-edit: ';
// echo updatePlaylistField(1, PlaylistFields::NAME, 'helo');
// echo ' - playlist: ';
// echo addPlaylist(1, 'new-playlist-2', 'picture');

addSong(1, "song-1", "song_1.mp3");
updateSongFields(1, SongFields::PICTURE_PATH, "new path");
