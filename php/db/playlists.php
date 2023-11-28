<?php

require_once __DIR__ . '/../conn.php';
require_once 'errors.php';
require_once __DIR__ . '/../save_file.php';
require_once 'saved.php';

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

function addPlaylist(int $user_id, string $name, string $picture_path = "")
{
    if (empty($name)) {
        throw new InvalidFieldException(PlaylistFields::NAME, $name);
    }

    if ($user_id < 0) {
        throw new InvalidFieldException(PlaylistFields::FK_USER_ID_CREATED_BY, $user_id);
    }

    $conn = create_conn();;

    if (!empty($picture_path)) {
        if (!file_exists(__DIR__ . '/../../' . $picture_path)) {
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

    $inserted_id = $stmt->insert_id;

    return $inserted_id;
}

function updatePlaylistField(int $id, string $field, $value): void
{
    $conn = create_conn();;

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

function fetchSavedPlaylsitsForUser(int $user_id): array
{
    if ($user_id < 0) {
        throw new InvalidFieldException('user_id', $user_id);
    }

    $sql = "SELECT playlists.*  from playlists
            join saved on playlists.id = saved.fk_playlist_id
            where playlists.active = 1 and saved.active = 1 and saved.fk_user_id = ?";

    $conn = create_conn();;
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('i', $user_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        return [];
    }

    $playlists = $result->fetch_all(MYSQLI_ASSOC);

    return $playlists;
}

function fetchPlaylist(int $id): array
{
    if ($id < 0) {
        throw new InvalidFieldException('id', $id);
    }

    $sql = "SELECT * from playlists where id = ? and active = 1";

    $conn = create_conn();;
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('i', $id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        return [];
    }

    $playlists = $result->fetch_all(MYSQLI_ASSOC);

    return $playlists;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create-playlist'])) {
        if (isset($_FILES['picture']))
            $path = save_file($_FILES['picture'], $_POST['type'], $_POST['playlist-name']);
        else $path = 'db/playlists/pictures/default.png';
        if ($path === null) die('failed while saving file');
        echo $path;

        $playlist_id = addPlaylist($_SESSION['user-id'], $_POST['playlist-name'], $path);
        savePlaylistForUser($_SESSION['user-id'], $playlist_id);
    }
}
