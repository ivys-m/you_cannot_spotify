<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}

global $password_value;
?>

<div class="module-password-input-container">
    <div class="text-container">
        <label for="password-input"><?= $_GET['password-title'] ?></label>
    </div>
    <div class="input-container">
        <input id="password-input" type="password" placeholder="<?= $_GET['password-placeholder'] ?>" value="<?= $_GET['password-value'] ?? $password_value ?? '' ?>">
    </div>
</div>