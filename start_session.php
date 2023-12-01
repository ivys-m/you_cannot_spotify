<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './php/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('how in the f-');
}

if (isset($_POST['login'])) {
    $email_or_username = $_POST['email-username'];
    $userPassword = $_POST['password'];
    $userPassword = md5($userPassword);

    $conn = create_conn();

    $sql = "SELECT * from users where (email = ? or username = ?) and password = ? limit 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('sss', $email_or_username, $email_or_username, $userPassword);

    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();
} else if (isset($_POST['register'])) {
    $userEmail = $_POST['email'];
    $userUsername = $_POST['username'];
    $userPassword = md5($_POST['password']);
    $userType = $_POST['type'];

    $conn = create_conn();

    // check for account with existng name/email

    $sql = "SELECT * from users where (email=? or username=?) and active = 1 limit 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('ss', $userEmail, $userUsername);

    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();
    if ($user !== null) {
        die('username or mail already exists');
    }

    // user doesn't exist... yet

    $sql = "INSERT into users (username, password, email, type) values (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->bind_param('ssss', $userUsername, $userPassword, $userEmail, $userType);

    $stmt->execute();

    $userId = $stmt->insert_id;

    // load user record to store in session
    $sql = "SELECT * from users where id = $userId and active = 1 limit 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new mysqli_sql_exception('stmt error');
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    die('huh?!');
}

if ($user !== null) {
    $_SESSION['user-id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['date_of_creation'] = $user['date_of_creation'];
    $_SESSION['profile_picture_path'] = $user['profile_picture_path'];
    $_SESSION['type'] = $user['type'];
}

echo json_encode($user);
