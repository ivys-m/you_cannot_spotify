<?php

require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/../db/playlists.php';

$admin_id = 100;

$playlists = fetchSavedPlaylsitsForUser($admin_id);

echo json_encode($playlists);
