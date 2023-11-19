<?php

require_once 'errors.php';
require_once 'users.php';
require_once 'playlists.php';

class SavedFields
{
    const ID = 'id';
    const FK_USER_ID = 'fk_user_id';
    const FK_PLAYLIST_ID = 'fk_playlist_id';

    const ALLOWED_FIELDS = [
        SavedFields::FK_USER_ID,
        SavedFields::FK_PLAYLIST_ID,
    ];
}

function savePlaylistForUser(int $user_id, int $playlist_id): void
{
    if ($user_id < 0) {
        throw new InvalidFieldException(SavedFields::FK_USER_ID, $user_id);
    }

    if ($playlist_id < 0) {
        throw new InvalidFieldException(SavedFields::FK_PLAYLIST_ID, $playlist_id);
    }

    global $conn;

    $sql = 'insert into saved (fk_user_id, fk_playlist_id) values (?, ?)';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('ii', $user_id, $playlist_id);

    $stmt->execute();
}

function checkForSavedRecord(int $user_id, int $playlist_id, int $active): void
{
    if ($user_id < 0) {
        throw new InvalidFieldException(SavedFields::FK_USER_ID, $user_id);
    }

    if ($playlist_id < 0) {
        throw new InvalidFieldException(SavedFields::FK_PLAYLIST_ID, $playlist_id);
    }

    global $conn;

    $check_sql = "select * from saved where fk_user_id = ? and fk_playlist_id = ? and active = $active limit 1";
    $check_stmt = $conn->prepare($check_sql);

    if (!$check_stmt) {
        throw new mysqli_sql_exception('check stmt error');
    }

    $check_stmt->bind_param('ii', $user_id, $playlist_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows === 0) {
        throw new RecordNotFoundException('saved');
    }
}

function savedSetActive(int $user_id, int $playlist_id, int $active): void
{
    checkForSavedRecord($user_id, $playlist_id, (int)!$active);

    global $conn;

    $update_sql = "update saved set active = $active where fk_user_id = ? and fk_playlist_id = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        throw new mysqli_sql_exception('update stmt error');
    }

    $update_stmt->bind_param('ii', $user_id, $playlist_id);
    $update_stmt->execute();
}

function deactivatePlaylistForUser($user_id, $playlist_id): void
{
    savedSetActive($user_id, $playlist_id, 0);
}

function activatePlaylistForUser(int $user_id, $playlist_id): void
{
    savedSetActive($user_id, $playlist_id, 1);
}