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
    <section id="reviews" class="reviews-section">
        <h2>Klantenrecensies</h2>

        <?php if (isset($reviewError)): ?>
            <p class="error-message"><?= htmlspecialchars($reviewError) ?></p>
        <?php endif; ?>

        <div class="review-form-container white-background">
            <h3>Laat een recensie achter</h3>
            <form action="/car-detail?id=<?= $car['id'] ?>" method="POST" class="review-form">
                <div class="form-group">
                    <label for="user_name">Naam:</label>
                    <input type="text" id="user_name" name="user_name" required>
                </div>
                <div class="form-group">
                    <label for="rating">Beoordeling:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 sterren">★</label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 sterren">★</label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 sterren">★</label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 sterren">★</label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 ster">★</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Reactie:</label>
                    <textarea id="comment" name="comment" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit_review" class="button-primary">Recensie plaatsen</button>
            </form>
        </div>

        <div class="existing-reviews">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-card white-background">
                        <div class="review-header">
                            <span class="reviewer-name"><?= htmlspecialchars($review['user_name']) ?></span>
                            <span class="review-date"><?= date('d M Y', strtotime($review['created_at'])) ?></span>
                        </div>
                        <div class="review-rating">
                            <span class="stars stars-<?= htmlspecialchars($review['rating']) ?>"></span>
                        </div>
                        <p class="review-comment"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-reviews">Nog geen recensies voor deze auto.</p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php require "includes/footer.php" ?>
