<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}

global $email_value;
?>

<div class="module-email-input-container">
    <div class="text-container">
        <label for="email-input"><?= $_GET['email-title'] ?></label>
    </div>
    <div class="input-container">
        <input id="email-input" type="email" placeholder="<?= $_GET['email-placeholder'] ?>" value="<?= $_GET['email-value'] ?? $email_value ?? '' ?>">
    </div>
</div>