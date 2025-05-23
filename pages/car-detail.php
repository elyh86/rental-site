<?php require "includes/header.php" ?>

<?php
require_once __DIR__ . '/../database/connection.php';

$car = null;
$error = '';

// Get car id from query parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->execute([$id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$car) {
        $error = 'Auto niet gevonden.';
    }
} else {
    $error = 'Geen auto opgegeven.';
}
?>
<main class="car-detail">
    <div class="grid">
        <?php if ($error): ?>
            <div class="row">
                <div class="advertorial">
                    <h2><?= htmlspecialchars($error) ?></h2>
                    <a href="/ons-aanbod" class="button-primary">Terug naar aanbod</a>
                </div>
            </div>
        <?php else: ?>
        <div class="row">
            <div class="advertorial">
                <h2><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></h2>
                <p><?= htmlspecialchars($car['description']) ?></p>
                <img src="/<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
        </div>
        <div class="row white-background">
            <h2><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></h2>
            <div class="rating">
                <span class="stars stars-4"></span>
                <span>440+ reviewers</span>
            </div>
            <p><?= htmlspecialchars($car['description']) ?></p>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type Car</span><span><?= htmlspecialchars($car['category']) ?></span></div>
                    <div class="row"><span class="accent-color">Capacity</span><span><?= htmlspecialchars($car['capacity']) ?></span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">Steering</span><span><?= htmlspecialchars($car['transmission']) ?></span></div>
                    <div class="row"><span class="accent-color">Gasoline</span><span><?= htmlspecialchars($car['fuel_capacity']) ?></span></div>
                </div>
                <div class="call-to-action">
                    <div class="row"><span class="font-weight-bold">€<?= number_format($car['price'], 2, ',', '.') ?></span> / dag</div>
                    <div class="row"><a href="#" class="button-primary">Huur nu</a></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php require "includes/footer.php" ?>
