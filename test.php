<?

header('Content-Type: text/plain');

require('php/users.php');
require('php/playlists.php');

$conn;
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'you_cannot_spotify';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed \'' . $conn->connect_error . '\'');
}

addUser('new-user');

updatePlaylistField(1, PlaylistFields::NAME, 'helo');
addPlaylist('new-playlist');
addPlaylist('new-playlist-2', 'picture');
