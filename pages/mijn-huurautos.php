<?php
require_once "includes/header.php";
require_once "database/connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

// Haal alle rentals van deze gebruiker op
$stmt = $conn->prepare("SELECT rentals.*, cars.brand, cars.model, cars.image_url FROM rentals JOIN cars ON rentals.car_id = cars.id WHERE rentals.user_id = :user_id ORDER BY rentals.start_date DESC");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="account-page">
    <div class="container">
        <h1>Mijn gehuurde auto's</h1>
        <?php if (empty($rentals)): ?>
            <p>Je hebt nog geen auto's gehuurd.</p>
        <?php else: ?>
            <div class="account-sections" style="display:block;">
                <?php foreach ($rentals as $rental): ?>
                    <div class="white-background" style="margin-bottom:2rem;display:flex;align-items:center;gap:2rem;">
                        <?php if (!empty($rental['image_url'])): ?>
                            <img src="<?= htmlspecialchars($rental['image_url']) ?>" alt="<?= htmlspecialchars($rental['brand'].' '.$rental['model']) ?>" style="width:120px;height:80px;object-fit:cover;border-radius:8px;">
                        <?php endif; ?>
                        <div>
                            <h2 style="margin:0 0 0.5em 0;"> <?= htmlspecialchars($rental['brand'].' '.$rental['model']) ?> </h2>
                            <div>Gehuurd van <b><?= htmlspecialchars($rental['start_date']) ?></b> t/m <b><?= htmlspecialchars($rental['end_date']) ?></b></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php require "includes/footer.php"; ?> 