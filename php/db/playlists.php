<?php

require_once 'errors.php';

class PlaylistFields
{
    const ID = 'id';
    const NAME = 'name';
    const PICTURE_PATH = 'picture_path';
    const FK_USER_ID_CREATED_BY = 'fk_user_id_created_by';

    const ALLOWED_FIELDS = [
        PlaylistFields::NAME,
        PlaylistFields::PICTURE_PATH,
        PlaylistFields::FK_USER_ID_CREATED_BY
    ];
}

function addPlaylist(int $user_id, string $name, string $picture_path = ""): void
{
    if (empty($name)) {
        throw new InvalidFieldException(PlaylistFields::NAME, $name);
    }

    if ($user_id < 0) {
        throw new InvalidFieldException(PlaylistFields::FK_USER_ID_CREATED_BY, $user_id);
    }

    global $conn;

    if (!empty($picture_path)) {
        if (!file_exists($picture_path)) {
            throw new InvalidFieldException(PlaylistFields::PICTURE_PATH, $picture_path);
        }

        $sql = "insert into playlists (name, picture_path, fk_user_id_created_by) values (?, ?, ?)";
    } else {
        $sql = "insert into playlists (name, fk_user_id_created_by) values (?, ?)";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    if (!empty($picture_path)) {
        $stmt->bind_param('ssi', $name, $picture_path, $user_id);
    } else {
        $stmt->bind_param('si', $name, $user_id);
    }

    $stmt->execute();
}

function updatePlaylistField(int $id, string $field, $value): void
{
    global $conn;

    if (empty($field) || !in_array($field, PlaylistFields::ALLOWED_FIELDS)) {
        throw new InvalidFieldException('field', $field);
    }

    if ($id < 0) {
        throw new InvalidFieldException(PlaylistFields::FK_USER_ID_CREATED_BY, $id);
    }

    if ($field === PlaylistFields::PICTURE_PATH && !file_exists($value)) {
        throw new FileNotFoundException($value);
    }

    $sql = "UPDATE playlists SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('si', $value, $id);

    $stmt->execute();
}
