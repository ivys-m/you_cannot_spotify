<?php

require_once 'errors.php';

class SongFields
{
    const ID = 'id';
    const NAME = 'name';
    const SONG_PATH = 'song_path';
    const PICTURE_PATH = 'picture_path';
    const FK_USER_ID_UPLOADED_BY = 'fk_user_id_uploaded_by';

    const ALLOWED_FIELDS =
    [
        SongFields::NAME,
        SongFields::SONG_PATH,
        SongFields::PICTURE_PATH,
        SongFields::FK_USER_ID_UPLOADED_BY,
    ];
}

function addSong(int $user_id, string $name, string $song_path, string $picture_path = ""): void
{
    if (empty($name)) {
        throw new InvalidFieldException(SongFields::NAME, $name);
    }

    if (empty($song_path)) {
        throw new InvalidFieldException(SongFields::SONG_PATH, $song_path);
    }

    if (!file_exists($song_path)) {
        throw new FileNotFoundException($song_path);
    }

    if ($user_id < 0) {
        throw new InvalidFieldException(SongFields::FK_USER_ID_UPLOADED_BY, $user_id);
    }

    global $conn;

    if (!empty($picture_path)) {
        if (!file_exists($picture_path)) {
            throw new FileNotFoundException($picture_path);
        }

        $sql = "insert into songs (name, song_path, picture_path, fk_user_id_uploaded_by) values (?, ?, ?, ?)";
    } else {
        $sql = "insert into songs (name, song_path, fk_user_id_uploaded_by) values (?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    if (!empty($picture_path)) {
        $stmt->bind_param('sssi', $name, $song_path,  $picture_path, $user_id);
    } else {
        $stmt->bind_param('ssi', $name, $song_path, $user_id);
    }

    $stmt->execute();
}

function updateSongFields(int $id, string $field, $value): void
{
    global $conn;

    if (empty($field) || !in_array($field, SongFields::ALLOWED_FIELDS)) {
        throw new InvalidFieldException('field', $field);
    }

    if ($id < 0) {
        throw new InvalidFieldException(SongFields::ID, $id);
    }


    if (($field === SongFields::PICTURE_PATH || $field === SongFields::SONG_PATH) && !file_exists($value)) {
        throw new FileNotFoundException($value);
    }

    $sql = "UPDATE songs SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('si', $value, $id);

    $stmt->execute();
}
