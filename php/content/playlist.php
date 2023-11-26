<?php

require_once '../conn.php';
require_once '../db/playlists.php';
require_once '../db/contains.php';
require_once '../db/users.php';

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

    foreach ($playlist_content as &$song) {
        $song['author'] = fetchUserById($user_id)[UserFields::USERNAME];
    }
}
?>

<div class="content-playlist-container">
    <div class="content-playlist-container-header">
        <div class="content-playlist-container-image-container">
            <img src="<?= $playlist[PlaylistFields::PICTURE_PATH]?>"
                 alt="<?= $playlist[PlaylistFields::NAME] ?>"
                 id="content-playlist-image">
        </div>
        <div class="content-playlist-container-text-container">
            <h1><?= $playlist[PlaylistFields::NAME] ?></h1>
        </div>
    </div>

<?php
    foreach ($playlist_content as $song) {
?>
    <div class="song-container">
        <div class="picture-container">
            <img src="<?=$song[SongFields::PICTURE_PATH]?>"
                 alt="<?=$song[SongFields::NAME]?>">
        </div>
        <div class="text-container">
            <div class="title-container">
                <h4><?= $song[PlaylistFields::NAME]?></h4>
            </div>
            <div class="author-container">
                <h6><?= $song['author'] ?></h6>
            </div>
        </div>
        <div class="actions-container">
            <i class='bx bx-dots-horizontal-rounded'
               id="song-actions"
               data-song-id="<?=$song[SongFields::ID]?>">
            </i>
        </div>
    </div>
<?php
    }
?>
</div>
