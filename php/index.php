<?php

require_once './conn.php';
require_once './db/playlists.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_data = json_decode(file_get_contents("php://input"), true);

    if (isset($post_data['playlists'])) {
        // echo json_encode(fetchSavedPlaylsitsForUser($_SESSION['user-id']));

        $playlists = fetchSavedPlaylsitsForUser($_SESSION['user-id']);

        foreach ($playlists as $playlist) {
?>
            <a class="playlist-container">
                <div class="playlist-image-container">
                    <img class='bx' src='<?= $playlist[PlaylistFields::PICTURE_PATH] ?>'></img>
                </div>
                <div class="playlist-title">
                    <h6><?= $playlist[PlaylistFields::NAME] ?></h6>
                </div>
            </a>
<?php
        }
        
    }
}