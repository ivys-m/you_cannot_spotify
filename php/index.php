<?php

require_once './conn.php';
require_once './db/playlists.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_data = json_decode(file_get_contents("php://input"), true);

    if (isset($post_data['playlists'])) {
        // echo json_encode(fetchSavedPlaylsitsForUser($_SESSION['user-id']));

        $playlists = fetchSavedPlaylsitsForUser($_SESSION['user-id']);

        echo json_encode($playlists);
    }
}
