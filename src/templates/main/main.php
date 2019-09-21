<?php
include __DIR__ . '/../header.php';
?>
<form method="post">
    <label for="email">Введите искомый E-mail:</label>
    <input type="text" id="email" name="email" class="emailInput" value="<?= $_POST['email'] ?? '' ?>">
    <input type="submit" value="Искать" class="btn">
</form>

<p class="users-to-paste"></p>

<template id="user-template" style="display: none">
    <div class="user-similar-item">
        <span class="user-email"></span>
        <span class="user-name"></span>
        <span class="user-id"></span>
    </div>
</template>
<?php include __DIR__ . '/../footer.php'; ?>