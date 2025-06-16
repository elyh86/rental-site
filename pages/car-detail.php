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

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $userName = trim($_POST['user_name']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);
    $carId = $id; // Car ID from URL

    if (!empty($userName) && $rating >= 1 && $rating <= 5 && !empty($comment) && $carId) {
        try {
            $stmt = $conn->prepare("INSERT INTO reviews (car_id, user_name, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$carId, $userName, $rating, $comment]);
            // Redirect to prevent form resubmission
            header('Location: /car-detail?id=' . $carId . '#reviews');
            exit;
        } catch (PDOException $e) {
            // Handle database error, e.g., display a message
            $reviewError = 'Er is een fout opgetreden bij het plaatsen van uw recensie.';
        }
    } else {
        $reviewError = 'Vul alle velden correct in.';
    }
}

// Fetch reviews for the current car
$reviews = [];
if ($car) {
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE car_id = ? ORDER BY created_at DESC");
    $stmt->execute([$car['id']]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <div class="row">
                        <span class="availability available" style="margin-right: 10px;">Beschikbaar</span>
                        <a href="/rent-car?id=<?= $car['id'] ?>" class="button-primary">Huur nu</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if ($car): // Only show review section if car exists ?>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Wat onze klanten zeggen</h3>
                <?php if (empty($reviews)): ?>
                    <div class="empty-reviews">
                        <i class="bi bi-chat-square-text"></i>
                        <p>Nog geen reviews voor deze auto.</p>
                        <p class="text-muted">Wees de eerste om een review te schrijven!</p>
                    </div>
                <?php else: ?>
                    <div class="reviews-grid">
                        <?php foreach ($reviews as $review): ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <h4><?= htmlspecialchars($review['user_name']) ?></h4>
                                        <div class="rating">
                                            <span class="stars stars-<?= $review['rating'] ?>"></span>
                                            <span class="rating-text"><?= $review['rating'] ?>/5</span>
                                        </div>
                                    </div>
                                    <div class="review-date">
                                        <i class="bi bi-calendar3"></i>
                                        <?= date('d-m-Y', strtotime($review['created_at'])) ?>
                                    </div>
                                </div>
                                <p class="review-comment"><?= htmlspecialchars($review['comment']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php require "includes/footer.php" ?>
