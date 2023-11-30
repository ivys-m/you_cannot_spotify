<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}

global $picture_source;
?>


<div class="module-input-picture-container">
    <div class="image-container">
        <img id="input-picture-image" src="<?= $picture_source
                                                ?? (isset($_GET['playlist'])
                                                    ? "db/playlists/pictures/default.png"
                                                    : "db/songs/pictures/default.png") ?>">
    </div>

    <div class="file-input">
        <input type="file" id="picture-input" accept="image/*">
    </div>
</div>