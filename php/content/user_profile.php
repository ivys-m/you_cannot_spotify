<?php
require_once __DIR__ . '/../conn.php';

$text_value = $_SESSION['username'];
$picture_source = $_SESSION['profile_picture_path'];
$email_value = $_SESSION['email'];
?>

<div class="user-profile-container">
    <div class="content">
        <div class="input-text">
            <?php
            require('input/input_text.php');
            ?>
        </div>
        <div class="input-picture">
            <?php
            require('input/input_picture.php');
            ?>
        </div>
        <div class="input-password">
            <?php
            require('input/input_password.php');
            ?>
        </div>
        <div class="input-email">
            <?php
            require('input/input_email.php');
            ?>
        </div>
    </div>
    <div class="button-container">
        <button id="update">save changes</button>
        <button id="logout">logout</button>
    </div>
</div>