<?php

class PlaylistFields
{
    const NAME = 'name';
    const PICTURE_PATH = 'picture_path';
    const FK_USER_ID_CREATED_BY = 'fk_user_id_created_by';

    const ALLOWED_FIELDS =
    [
        PlaylistFields::NAME,
        PlaylistFields::PICTURE_PATH,
        PlaylistFields::FK_USER_ID_CREATED_BY
    ];
}

function addPlaylist(int $user_id, string $name, string $picture_path = ""): bool
{
    if (empty($name)) {
        return false;
    }

    global $conn;

    if (!empty($picture_path)) {
        if (!file_exists($picture_path)) {
            return false;
        }

        $sql = "insert into playlists (name, picture_path, fk_user_id_created_by) values (?, ?, ?)";
    } else {
        $sql = "insert into playlists (name, fk_user_id_created_by) values (?, ?)";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    if (!empty($picture_path)) {
        $stmt->bind_param('ssi', $name, $picture_path, $user_id);
    } else {
        $stmt->bind_param('si', $name, $user_id);
    }

    return $stmt->execute();
}

function updatePlaylistField(int $id, string $field, $value): bool
{
    global $conn;

    if (empty($field) || $id < 0) {
        return false;
    }

    if (!in_array($field, PlaylistFields::ALLOWED_FIELDS)) {
        return false;
    }

    if ($field === PlaylistFields::PICTURE_PATH && !file_exists($value)) {
        return false;
    }

    $sql = "UPDATE playlists SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('si', $value, $id);

    return $stmt->execute();
}
