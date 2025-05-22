<?php
require "includes/header.php";
?>
<main>
    <form action="/login-handler" class="account-form" method="post">
        <h2>Log in</h2>
        <?php if (isset($_GET['error'])) { ?>
            <div class="message"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="succes-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php } ?>
        <label for="email">Uw e-mail</label>
        <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>" required autofocus>
        <label for="password">Uw wachtwoord</label>
        <input type="password" name="password" id="password" placeholder="Uw wachtwoord" required>
        <div class="remember-me">
            <input type="checkbox" name="remember_me" id="remember_me" value="1">
            <label for="remember_me">Ingelogd blijven</label>
        </div>
        <input type="submit" value="Log in" class="button-primary">
    </form>
</main>

<?php require "includes/footer.php" ?>
