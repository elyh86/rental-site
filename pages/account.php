<?php
require_once "includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

// Get user data
$stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<main class="account-page">
    <div class="container">
        <h1>Account Instellingen</h1>
        
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="message <?= isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'error' ?>">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        } ?>

        <div class="account-sections">
            <section class="profile-section">
                <h2>Profiel Informatie</h2>
                <form action="/actions/update-profile.php" method="POST" class="account-form">
                    <div class="form-group">
                        <label for="email">E-mailadres</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefoonnummer</label>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                    </div>

                    <button type="submit" class="button-primary">Profiel Bijwerken</button>
                </form>
            </section>

            <section class="password-section">
                <h2>Wachtwoord Wijzigen</h2>
                <form action="/actions/change-password.php" method="POST" class="account-form">
                    <div class="form-group">
                        <label for="current_password">Huidig Wachtwoord</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nieuw Wachtwoord</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Bevestig Nieuw Wachtwoord</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="button-primary">Wachtwoord Wijzigen</button>
                </form>
            </section>
        </div>
    </div>
</main>

<?php require "includes/footer.php" ?>
