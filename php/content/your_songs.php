<?php
require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/../db/songs.php';
?>

<div class="content-playlist-container" id="your-songs-container">
    <?php
    $songs = getUserSongs($_SESSION['user-id']);

    foreach ($songs as $song) {
    ?>
        <div class="song-container" id="your-song-container-<?= $song[SongFields::ID] ?>">
            <div class="picture-container">
                <img src="<?= $song[SongFields::PICTURE_PATH] ?>" alt="<?= $song[SongFields::NAME] ?>">
            </div>
            <div class="text-container">
                <div class="title-container">
                    <h4><?= $song[SongFields::NAME] ?></h4>
                </div>
            </div>
            <div class="actions-container">
                <i class='bx bx-dots-horizontal-rounded' id="song-actions" data-song-id="<?= $song[SongFields::ID] ?>"></i>
                <i class='bx bx-x' id="song-actions-delete" data-song-id="<?= $song[SongFields::ID] ?>"></i>
            </div>
        </div>
    <?php
    }
    ?>

</div>