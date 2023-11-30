<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}

global $text_value;
?>

<div class="module-text-input-container">
    <div class="text-container">
        <label for="text-input"><?= $_GET['text-title'] ?></label>
    </div>
    <div class="input-container">
        <!-- uhm -->
        <input id="text-input" type="text"
            placeholder="<?= $_GET['text-placeholder'] ?>"
            value="<?= $_GET['text-value'] ?? $text_value ?? '' ?>"
        >
    </div>
</div>