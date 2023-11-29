<?php

require_once __DIR__ . '/../conn.php';
require_once 'errors.php';
require_once __DIR__ . '/../save_file.php';

// i want union types back

class SongFields
{
    const ID = 'id';
    const NAME = 'name';
    const SONG_PATH = 'song_path';
    const PICTURE_PATH = 'picture_path';
    const FK_USER_ID_UPLOADED_BY = 'fk_user_id_uploaded_by';
    const ACTIVE = 'active';

    const ALLOWED_FIELDS =
    [
        SongFields::NAME,
        SongFields::SONG_PATH,
        SongFields::PICTURE_PATH,
        SongFields::FK_USER_ID_UPLOADED_BY,
        SongFields::ACTIVE,
    ];
}

function addSong(int $user_id, string $name, string $song_path, string $picture_path = ""): string
{
    if (empty($name)) {
        throw new InvalidFieldException(SongFields::NAME, $name);
    }

    if (empty($song_path)) {
        throw new InvalidFieldException(SongFields::SONG_PATH, $song_path);
    }

    if (!file_exists(__DIR__ . '/../../' . $song_path)) {
        throw new FileNotFoundException($song_path);
    }

    if ($user_id < 0) {
        throw new InvalidFieldException(SongFields::FK_USER_ID_UPLOADED_BY, $user_id);
    }

    $conn = create_conn();;

    if (!empty($picture_path)) {
        if (!file_exists(__DIR__ . '/../../' . $picture_path)) {
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

    $inserted_id = $stmt->insert_id;

    return $inserted_id;
}

function updateSongFields(int $id, string $field, $value): bool
{
    $conn = create_conn();

    if (empty($field) || !in_array($field, SongFields::ALLOWED_FIELDS)) {
        throw new InvalidFieldException('field', $field);
    }

    if ($id < 0) {
        throw new InvalidFieldException(SongFields::ID, $id);
    }


    if (($field === SongFields::PICTURE_PATH || $field === SongFields::SONG_PATH) && !file_exists(__DIR__ . '/../../' . $value)) {
        throw new FileNotFoundException($value);
    }

    $sql = "UPDATE songs set $field = $value where id = $id";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    // $stmt->bind_param('si', $value, $id);

    return $stmt->execute();
}

function getUserSongs(int $user_id): array
{
    $conn = create_conn();

    if ($user_id < 0) {
        throw new InvalidFieldException(UserFields::ID, $user_id);
    }

    $sql = "SELECT * from songs where fk_user_id_uploaded_by = ? and active = 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('i', $user_id);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create-song'])) {
        if (isset($_FILES['picture-file']) && $_FILES['picture-path'] !== 'default')
            $pic_path = save_file($_FILES['picture-file'], $_POST['type'], $_POST['song-name']);
        else $pic_path = 'db/songs/pictures/default.png';

        if (isset($_FILES['song-file']) && $_FILES['song-file'])
            $song_path = save_file($_FILES['song-file'], $_POST['type'], $_POST['song-name']);
        else die('missing song path');

        if ($song_path === null || $pic_path === null) die('failed while saving file');
        echo 'song_path: ' . $song_path . ' - picture_path: ' . $pic_path;

        // $playlist_id = addPlaylist($_SESSION['user-id'], $_POST['playlist-name'], $pic_path);
        $song_id = addSong($_SESSION['user-id'], $_POST['song-name'], $song_path, $pic_path);
        // savePlaylistForUser($_SESSION['user-id'], $playlist_id);
    } else if (isset($_POST['delete'])) {
        if (!isset($_POST['song-id'])) {
            die('missing song id');
        }

        // echo 'removing ' . $_POST['song-id'];

        $result = updateSongFields($_POST['song-id'], SongFields::ACTIVE, 0);

        if ($result) echo 'success';
        else echo 'fail';
    }
}
