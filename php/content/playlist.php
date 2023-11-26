<?php

require_once '../conn.php';
require_once '../db/playlists.php';
require_once '../db/contains.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id']))
        die('how tf did we get here');

    $playlist_id = $_GET['id'];
    $user_id = $_SESSION['user-id'];

    $playlist = fetchPlaylist($playlist_id)[0];

    $playlist_content = fetchAllPlaylistContains($playlist_id);
    
    // foreach ($playlist as $key => $value) {
    //     echo "$key: $value<br>";
    // }
    // echo '<br>';
    // foreach ($playlist_content as $song) {
    //     foreach ($song as $key => $value) {
    //         echo "$key: $value<br>";
    //     }
    // }
}
?>

<div class="content-playlist-container">
    <div class="content-playlist-container-header">
        <div class="content-playlist-container-image-container">
            <img src="<?= $playlist[PlaylistFields::PICTURE_PATH]?>">
        </div>
        <div class="content-playlist-container-text-container">
            <h1><?= $playlist[PlaylistFields::NAME] ?></h1>
        </div>
    </div>
</div>
