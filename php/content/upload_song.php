<?php

require_once __DIR__ . '/../db/songs.php';

if (isset($_GET['song-id'])) {
    $song_record = getSongFromId($_GET['song-id'])[0];

    $text_value = $song_record[SongFields::NAME];
    $picture_source = $song_record[SongFields::PICTURE_PATH];
}

?>

<div class="upload-song-container">
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
        <div class="input-audio-file">
            <?php
            if (!isset($_GET['song-id']))
                require('input/input_file.php');
            ?>
        </div>
    </div>
    <div class="button-container">
        <button id="<?= isset($_GET['song-id']) ? 'update-song-button' : 'upload-song-button' ?>" data-song-id="<?= $_GET['song-id'] ?? '-1' ?>">
            <?= isset($_GET['song-id']) ? 'update' : 'upload' ?>
        </button>
    </div>
</div>