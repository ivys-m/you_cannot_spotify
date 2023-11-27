<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}
?>


<div class="module-input-picture-container">
    <div class="image-container">
        <img id="input-picture-image" src="db/playlists/pictures/first-playlist-2.png">
    </div>

    <div class="file-input">
        <input type="file" id="picture-input" accept="image/*">
    </div>
</div>