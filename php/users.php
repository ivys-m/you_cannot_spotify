<?php

class UserFields
{
    const USERNAME = 'username';
    const PROFILE_PICTURE_PATH = 'profile_picture_path';
    const TYPE = 'type';

    const ALLOWED_FIELDS = [UserFields::USERNAME, UserFields::PROFILE_PICTURE_PATH, UserFields::TYPE];
}

function addUser(string $username): bool
{
    if (empty($username)) {
        return false;
    }

    global $conn;

    $sql = "insert into users (username) values (?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('s', $username);

    return $stmt->execute();
}

function updateUserField(int $id, string $field, string $value): bool
{
    global $conn;

    if (empty($field) || empty($value) || $id < 0) {
        return false;
    }
    if (!in_array($field, UserFields::ALLOWED_FIELDS)) {
        return false;
    }
    if ($field === UserFields::PROFILE_PICTURE_PATH && !file_exists($value)) {
        return false;
    }
    $sql = "UPDATE users SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('si', $value, $id);

    return $stmt->execute();
}
