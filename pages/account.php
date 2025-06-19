<?php 
session_start();
require "includes/header.php";

// Redirect to home if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit();
}

// Get current user info
require_once "database/connection.php";
$stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
$stmt->bindParam(":id", $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Include account styling -->
<link rel="stylesheet" href="/assets/css/account.css">

<main>
    <div class="account-container">
        <div class="account-card">
            <h2 class="account-title">Mijn Account</h2>
                <div class="profile-center">
                    <div class="profile-container">
                        <div class="profile-image-wrapper">
                            <img src="<?= !empty($user['profile_image']) ? $user['profile_image'] : 'assets/images/profil.png' ?>" alt="Profiel foto" id="profile-preview" class="profile-image">
                        </div>
                        <div class="camera-button" onclick="document.getElementById('profile_image').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                    <h3 class="user-email"><?= htmlspecialchars($user['email']) ?></h3>
                    <p class="account-date">Account sinds <?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                    
                    <div class="photo-section">
                        <p class="photo-info">Wijzig je profielfoto door op het camera-icoon te klikken of kies een bestand hieronder:</p>
                        <label for="profile_image" class="file-input-label">
                            <span class="file-input-text">Kies een foto</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Rechter kolom - Formulier -->
            <div class="form-section">
                <?php if (isset($_SESSION['account_message'])): ?>
                    <div class="notification <?= strpos($_SESSION['account_message'], 'gelukt') !== false ? 'succes-message' : 'message' ?>">
                        <?= $_SESSION['account_message'] ?>
                    </div>
                    <?php unset($_SESSION['account_message']); ?>
                <?php endif; ?>
                
                <form action="/update-account" method="post" enctype="multipart/form-data">
                    <input type="file" id="profile_image" name="profile_image" style="display: none;" accept="image/*">
                    
                    <!-- Persoonlijke gegevens sectie -->
                    <div class="form-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3563E9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <h3 class="section-title">Persoonlijke Gegevens</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">E-mailadres</label>
                            <div class="input-container">
                                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-input" required>
                                <div class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Wachtwoord sectie -->
                    <div class="form-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3563E9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <h3 class="section-title">Wachtwoord Wijzigen</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="current_password" class="form-label">Huidig wachtwoord</label>
                            <div class="input-container">
                                <input type="password" id="current_password" name="current_password" class="form-input" required>
                                <div class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password" class="form-label">Nieuw wachtwoord</label>
                            <div class="input-container">
                                <input type="password" id="new_password" name="new_password" class="form-input">
                                <div class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                            </div>
                            <small>Laat leeg als je je wachtwoord niet wilt wijzigen</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Bevestig nieuw wachtwoord</label>
                            <div class="input-container">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-input">
                                <div class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit knop -->
                    <div class="submit-container">
                        <button type="submit" class="submit-button">
                            <div class="button-content">
                                <span>Wijzigingen opslaan</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Preview profile image before upload
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profile-preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?php require "includes/footer.php" ?>
