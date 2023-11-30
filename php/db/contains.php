<?php

require_once 'errors.php';
require_once 'playlists.php';
require_once 'songs.php';

class ContainsFields
{
    const ID = 'id';
    const FK_PLAYLIST_ID = 'fk_playlist_id';
    const FK_SONG_ID = 'fk_song_id';

    const ALLOWED_FIELDS = [
        ContainsFields::FK_PLAYLIST_ID,
        ContainsFields::FK_SONG_ID,
    ];
}

function checkForContainsRecord($song_id, $playlist_id, $active): void
{
    if ($song_id < 0) {
        throw new InvalidFieldException(ContainsFields::FK_SONG_ID, $song_id);
    }

    if ($playlist_id < 0) {
        throw new InvalidFieldException(ContainsFields::FK_PLAYLIST_ID, $playlist_id);
    }

    $conn = create_conn();;

    $check_sql = "select * from contains where fk_song_id = ? and fk_playlist_id = ? and active = $active limit 1";
    $check_stmt = $conn->prepare($check_sql);

    if (!$check_stmt) {
        throw new mysqli_sql_exception('check stmt error');
    }

    $check_stmt->bind_param('ii', $song_id, $playlist_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows() === 0) {
        throw new RecordNotFoundException('contains');
    }
}

function containsSetActive(int $song_id, int $playlist_id, int $active): bool
{
    checkForContainsRecord($song_id, $playlist_id, (int)!$active);

    $conn = create_conn();;

    $update_sql = "update contains set active = $active where fk_song_id = ? and fk_playlist_id = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        throw new mysqli_sql_exception('update stmt error');
    }

    $update_stmt->bind_param('ii', $song_id, $playlist_id);
    return $update_stmt->execute();
}

function addSongToPlaylist(int $song_id, int $playlist_id): bool
{
    try {
        checkForContainsRecord($song_id, $playlist_id, 1);
        return true;
    } catch (\Throwable $th) {
    }

    try {
        // setActive checks for existence
        $result = containsSetActive($song_id, $playlist_id, 1);
        return $result;
    } catch (\Throwable $th) {
    }

    // song isn't already in playlist

    $conn = create_conn();;

    $sql = 'insert into contains (fk_song_id, fk_playlist_id) values (?, ?)';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('ii', $song_id, $playlist_id);

    return $stmt->execute();
}



function removeSongFromPlaylist(int $song_id, int $playlist_id): bool
{
    return containsSetActive($song_id, $playlist_id, 0);
}

function fetchAllPlaylistContains(int $playlist_id): array
{
    if ($playlist_id < 0) {
        throw new InvalidFieldException(ContainsFields::FK_PLAYLIST_ID, $playlist_id);
    }

    $sql = "SELECT s.*
              from contains c
              join songs s on c.fk_song_id = s.id
              where c.fk_playlist_id = ?
                and c.active = 1
                and s.active = 1";

    $conn = create_conn();;
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('i', $playlist_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $songs = $result->fetch_all(MYSQLI_ASSOC);

    return $songs;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        if (!isset($_POST['song-id'], $_POST['playlist-id'])) {
            die('missing requried ids');
        }

        $result = removeSongFromPlaylist($_POST['song-id'], $_POST['playlist-id']);

        if ($result) echo 'success';
        else echo 'fail';
    } else if (isset($_POST['add'])) {
        if (!isset($_POST['song-id'], $_POST['playlist-id'])) {
            die('missing requried ids');
        }

        $result = addSongToPlaylist($_POST['song-id'], $_POST['playlist-id']);

        if ($result) echo 'success';
        else echo 'fail';
    }
}
