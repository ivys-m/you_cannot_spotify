<?php
require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/../db/songs.php';
?>

<div class="content-playlist-container" id="your-songs-container">
    <div class="button-container">
        <button id="your-songs-upload-song-button">
            <i class='bx bx-upload'></i>
            upload
        </button>
    </div>
    <div class="songs">
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
                    <i class='bx bxs-edit-alt' id="song-actions-edit" data-song-id="<?= $song[SongFields::ID] ?>"></i>
                    <i class='bx bx-x' id="song-actions-delete" data-song-id="<?= $song[SongFields::ID] ?>"></i>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>