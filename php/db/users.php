<?php

require_once 'errors.php';
require_once __DIR__ . '\\..\\conn.php';
require_once __DIR__ . '\\..\\save_file.php';

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

function checkForUserRecord(string $username, string $password, string $email): array
{
    if (empty($username)) {
        throw new InvalidArgumentException('missing username');
    }
    if (empty($password)) {
        throw new InvalidArgumentException('missing password');
    }
    if (empty($email)) {
        throw new InvalidArgumentException('missing email');
    }

    $conn = create_conn();

    $sql = "SELECT * from users where (email=? or username=?) limit 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('ss', $email, $username);

    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();
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
        $foundUser = checkForUserRecord($username, $password, $email);
        if ($foundUser !== null) {
            return false;
        }
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

    if ($field === UserFields::PROFILE_PICTURE_PATH && !file_exists(__DIR__ . '/../../' . $value)) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update-user'])) {
        if (isset($_POST['username'])) {
            updateUserField($_SESSION['user-id'], UserFields::USERNAME, $_POST['username']);
            $_SESSION['username'] = $_POST['username'];
        }
        if (isset($_POST['password'])) {
            updateUserField($_SESSION['user-id'], UserFields::PASSWORD, md5($_POST['password']));
        }
        if (isset($_FILES['profile-picture'])) {
            $picture_path = save_file($_FILES['profile-picture'], 'users', $_SESSION['username']);

            updateUserField($_SESSION['user-id'], UserFields::PROFILE_PICTURE_PATH, $picture_path);
            $_SESSION['profile_picture_path'] = $picture_path;
        }
        if (isset($_POST['email'])) {
            updateUserField($_SESSION['user-id'], UserFields::EMAIL, $_POST['email']);
            $_SESSION['email'] = $_POST['email'];
        }
        echo 'success';
    }
}
