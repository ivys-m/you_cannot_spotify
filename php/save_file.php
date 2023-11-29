<?php

function save_file(array $file, string $type, string $name)
{
    $relative_db_dir = 'db/';
    if ($type === 'song') {
        $relative_db_dir .= 'songs/';
    } else if ($type === 'playlist') {
        $relative_db_dir .= 'playlists/';
    } else if ($type === 'users') {
        $relative_db_dir .= 'users/';
    } else {
        die('invalid type');
    }

    if ($file['type'] == 'image/png' || $file['type'] == 'image/jpeg') {
        $relative_db_dir .= 'pictures/';
    } else if ($file['type'] == 'audio/mpeg') {
        $relative_db_dir .= 'audio/';
    } else {
        die('invalid file type');
    }

    if (!isset($name)) {
        die('missing playlist-name');
    }

    $original_file_name = $file['name'];
    $new_file_name = uniqid('playlist_') . '.' . time() . $name . '.' . pathinfo($original_file_name, PATHINFO_EXTENSION);
    $upload_file = $relative_db_dir . $new_file_name;

    $absolute_upload_path = __DIR__ . '/../' . $upload_file;

    if (move_uploaded_file($file['tmp_name'], $absolute_upload_path)) {
        return $upload_file;
    } else {
        return null;
    }
}
