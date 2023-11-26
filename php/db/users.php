<?php

require_once 'errors.php';

class UserFields
{
    const ID = 'id';
    const PASSWORD = 'password';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PROFILE_PICTURE_PATH = 'profile_picture_path';
    const TYPE = 'type';

    const ALLOWED_FIELDS = [UserFields::USERNAME, UserFields::PASSWORD, UserFields::EMAIL, UserFields::PROFILE_PICTURE_PATH, UserFields::TYPE];
}

function checkForUserRecord(string $email): array
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidFieldException(UserFields::EMAIL, $email);
    }

    $conn = create_conn();

    $sql = "select * from users where email = '$email' and active = 1 limit 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->execute();
    $stmt->store_result();

    if (!($stmt->num_rows > 0)) {
        throw new RecordNotFoundException('users');
    }

    $stmt->bind_result($user_id, $username, $password, $res_email, $date_of_creation, $profile_picture_path, $type, $active);
    $stmt->fetch();

    $user = [
        'id' => $user_id,
        'username' => $username,
        'password' => $password,
        'email' => $res_email,
        'date_of_creation' => $date_of_creation,
        'profile_picture_path' => $profile_picture_path,
        'type' => $type,
        'active' => $active,
    ];

    return $user;
}

function addUser(string $username, string $password, $email): bool
{
    if (empty($username)) {
        throw new InvalidFieldException(UserFields::USERNAME, $username);
    }

    if (empty($password)) {
        throw new InvalidFieldException(UserFields::PASSWORD, $password);
    }

    if (empty($email) || !filter_var($email, FILTER_SANITIZE_EMAIL)) {
        throw new InvalidFieldException(UserFields::PASSWORD, $email);
    }

    try {
        checkForUserRecord($email);
        return false;
    } catch (\Throwable $th) {
    }

    $conn = create_conn();;

    $sql = "insert into users (username, password, email) values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt exception');
    }

    $encrypted_password = md5($password);
    $stmt->bind_param('sss', $username, $encrypted_password, $email);

    $stmt->execute();

    return true;
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

    if ($field === UserFields::EMAIL && !filter_var($value, FILTER_SANITIZE_EMAIL)) {
        throw new InvalidFieldException($field, $value);
    }

    $conn = create_conn();;

    $sql = "UPDATE users SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('si', $value, $id);

    $stmt->execute();
}

function singup(string $username, string $password, string $email): bool|string
{
    $result = addUser($username, $password, $email);


    if (!$result) {
        return false;
    }

    $record = checkForUserRecord($email);

    $_SESSION['id'] = $record['id'];
    $_SESSION['username'] = $record['username'];
    $_SESSION['email'] = $record['email'];
    $_SESSION['date_of_creation'] = $record['date_of_creation'];
    $_SESSION['profile_picture_path'] = $record['profile_picture_path'];
    $_SESSION['type'] = $record['type'];

    return $record;
}

function login(string $username, string $password, string $email): bool|string
{
    try {
        $record = checkForUserRecord($email);
    } catch (\Throwable $th) {
        return false;
    }

    if ($record['username'] !== $username || $record['password'] !== md5($password)) {
        return false;
    }

    $_SESSION['id'] = $record['id'];
    $_SESSION['username'] = $record['username'];
    $_SESSION['email'] = $record['email'];
    $_SESSION['date_of_creation'] = $record['date_of_creation'];
    $_SESSION['profile_picture_path'] = $record['profile_picture_path'];
    $_SESSION['type'] = $record['type'];

    return json_encode($record);
}

function fetchUserById(int $id): array
{
    $conn = create_conn();;

    $sql = "select * from users where id = '$id' and active = 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->execute();
    $stmt->store_result();

    if (!($stmt->num_rows > 0)) {
        throw new RecordNotFoundException('users');
    }

    $stmt->bind_result($user_id, $username, $password, $res_email, $date_of_creation, $profile_picture_path, $type, $active);
    $stmt->fetch();

    $user = [
        'id' => $user_id,
        'username' => $username,
        'password' => $password,
        'email' => $res_email,
        'date_of_creation' => $date_of_creation,
        'profile_picture_path' => $profile_picture_path,
        'type' => $type,
        'active' => $active,
    ];

    return $user;
}
