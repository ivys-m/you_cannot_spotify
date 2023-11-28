<?php

?>

<div class="upload-song-container">
    <h2>upload song</h2>
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
            require('input/input_file.php');
            ?>
        </div>
    </div>
    <div class="button-container">
        <button id="upload-song-button">
            upload
        </button>
    </div>
</div>