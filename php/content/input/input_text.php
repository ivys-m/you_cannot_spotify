<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('how tf did we get here');
}
?>

<div class="module-text-input-container">
    <div class="text-container">
        <label for="text-input"><?= $_GET['text-title'] ?></label>
    </div>
    <div class="input-container">
        <input id="text-input" type="text" placeholder="<?= $_GET['text-placeholder'] ?>">
    </div>
</div>