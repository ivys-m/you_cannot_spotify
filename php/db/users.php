<?php

require_once 'errors.php';

class UserFields
{
    const ID = 'id';
    const USERNAME = 'username';
    const PROFILE_PICTURE_PATH = 'profile_picture_path';
    const TYPE = 'type';

    const ALLOWED_FIELDS = [UserFields::USERNAME, UserFields::PROFILE_PICTURE_PATH, UserFields::TYPE];
}

function addUser(string $username): void
{
    if (empty($username)) {
        throw new InvalidFieldException(UserFields::USERNAME, $username);
    }

    global $conn;

    $sql = "insert into users (username) values (?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('stmt exception');
    }

    $stmt->bind_param('s', $username);

    $stmt->execute();
}

function updateUserField(int $id, string $field, string $value): void
{
    if (empty($field) || !in_array($field, UserFields::ALLOWED_FIELDS)) {
        throw new InvalidFieldException('field', $field);
    }

    if (empty($value)) {
        throw new InvalidFieldException($field, $value);
    }

    if ($id < 0) {
        throw new InvalidFieldException(UserFields::ID, $id);
    }

    if ($field === UserFields::PROFILE_PICTURE_PATH && !file_exists($value)) {
        throw new FileNotFoundException($value);
    }

    global $conn;

    $sql = "UPDATE users SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('si', $value, $id);

    $stmt->execute();
}
