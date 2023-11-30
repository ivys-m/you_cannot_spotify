<?php
require_once __DIR__ . '/../db/playlists.php';

if (isset($_GET['playlist-id'])) {
    $playlist_record = fetchPlaylist($_GET['playlist-id'])[0];

    $text_value = $playlist_record[PlaylistFields::NAME];
    $picture_source = $playlist_record[PlaylistFields::PICTURE_PATH];
}
?>

<div class="create-playlist-container">
    <div class="content">
        <div class="input-text">
            <?php
            require('input/input_text.php');
            ?>
        </div>
        <div class="input-picture">
            <?php
            require('input/input_picture.php');
            ?>
        </div>
    </div>
    <div class="button-container">
        <button id="<?= isset($_GET['playlist-id']) ? 'update-playlist-button' : 'create-playlist-button' ?>" data-playlist-id="<?= $_GET['playlist-id'] ?? '-1' ?>">
            <?= isset($_GET['playlist-id']) ? 'update' : 'create' ?>
        </button>
    </div>
</div>