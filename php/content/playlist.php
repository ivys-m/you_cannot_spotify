<?php

require_once '../conn.php';
require_once '../db/playlists.php';
require_once '../db/contains.php';
require_once '../db/users.php';
require_once '../db/saved.php';
require_once '../db/songs.php';

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

    foreach ($playlist_content as $key => $song) {
        $playlist_content[$key]['author'] = fetchUserById($song[SongFields::FK_USER_ID_UPLOADED_BY])[UserFields::USERNAME];
    }

    try {
        checkForSavedRecord($user_id, $playlist_id, 1);
        $saved = true;
    } catch (\Throwable $th) {
        $saved = false;
    }
}
?>

<div class="content-playlist-container" id="content-playlist-container" data-id="<?= $playlist_id ?>">
    <div class="content-playlist-container-header">
        <div class="content-playlist-container-image-container">
            <img src="<?= $playlist[PlaylistFields::PICTURE_PATH] ?>" alt="<?= $playlist[PlaylistFields::NAME] ?>" id="content-playlist-image">
        </div>
        <div class="content-playlist-container-text-container">
            <h1 id="playlist-name-label"><?= $playlist[PlaylistFields::NAME] ?></h1>
        </div>
        <div class="content-playlist-container-actions-container">
            <div class="edit-container">
                <i class="bx bx-edit-alt" id="playlist-edit" data-playlist-id="<?= $playlist[PlaylistFields::ID] ?>"></i>
            </div>
            <div class="heart-container">
                <!-- why... just... why -->
                <?php
                if ($saved) {
                ?>
                    <i class="bx bxs-heart saved" id="saved-icons"></i>
                <?php
                } else {
                ?>
                    <i class="bx bx-heart" id="saved-icons"></i>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="search-bar-container">
        <div class="search-bar">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="search for a song to add" id="playlist-search-box">
        </div>
    </div>

    <div class="songs-outer-container" id="songs-outer-container">
        <?php
        foreach ($playlist_content as $key => $song) {
        ?>
            <div class="song-container" data-song-id="<?= $song['id'] ?>">
                <div class="picture-container">
                    <img src="<?= $song[SongFields::PICTURE_PATH] ?>" alt="<?= $song[SongFields::NAME] ?>">
                </div>
                <div class="text-container">
                    <div class="title-container">
                        <h4><?= $song[SongFields::NAME] ?></h4>
                    </div>
                    <div class="author-container">
                        <h6><?= $song['author'] ?></h6>
                    </div>
                </div>
                <div class="actions-container">
                    <!-- <i class='bx bx-dots-horizontal-rounded' id="song-actions" data-song-id="<?= $song[SongFields::ID] ?>">
                    </i> -->
                    <i class='bx bx-play' id="song-action-play" data-song-id="<?= $song['id'] ?>"></i>
                    <i class='bx bx-x' id="song-action-remove" data-song-id="<?= $song['id'] ?>"></i>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- <script type="module" src="scripts/content/playlist.js"> -->