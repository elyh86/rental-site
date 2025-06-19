<?php require "includes/header.php" ?>

<?php
// Include database connection
require_once __DIR__ . "/../database/connection.php";

// Get car ID from URL parameter
$carId = isset($_GET['id']) ? intval($_GET['id']) : 1;

try {
    // Fetch car data from database
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
    $stmt->bindParam(':id', $carId);
    $stmt->execute();
    
    // Check if car exists
    if ($stmt->rowCount() === 0) {
        // If car not found, get the first car
        $stmt = $conn->query("SELECT * FROM cars ORDER BY id LIMIT 1");
    }
    
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If no cars in database, show error message
    if (!$car) {
        echo "<div class='message'>No cars found in database. Please <a href='/setup_database.php'>setup the database</a> first.</div>";
        exit;
    }
    
    // Fetch reviews for this car
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE car_id = :car_id ORDER BY date DESC");
    $stmt->bindParam(':car_id', $car['id']);
    $stmt->execute();
    $carReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "<div class='message'>Database error: " . $e->getMessage() . "</div>";
    exit;
}

// No sample reviews - keep the array empty
if (empty($carReviews)) {
    $carReviews = [];
}
?>

<?php
// Display success or error messages if they exist
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="succes-message">Uw beoordeling is succesvol ingediend!</div>';
}

if (isset($_GET['error'])) {
    echo '<div class="message">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>

<main class="car-detail-page">
    <div class="car-detail-container">
        <div class="car-detail-left">
            <div class="car-detail-card">
                <div class="car-detail-hero">
                    <h2><?= $car['brand'] ?> - <?= $car['type'] ?></h2>
                    <p><?= $car['description'] ?></p>
                    <div class="car-hero-image">
                        <?php if(isset($car['main_image'])): ?>
                            <img src="assets/images/products/<?= $car['main_image'] ?>" alt="<?= $car['brand'] ?>">
                        <?php else: ?>
                            <img src="assets/images/products/car (0).svg" alt="Car Image">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="car-thumbnails">
                <?php foreach(range(1, 3) as $index): ?>
                <div class="car-thumbnail <?= $index === 1 ? 'active' : '' ?>">
                    <?php if(isset($car['main_image'])): ?>
                        <img src="assets/images/products/<?= $car['main_image'] ?>" alt="<?= $car['brand'] ?> view <?= $index ?>">
                    <?php else: ?>
                        <img src="assets/images/products/car (0).svg" alt="Car Image view <?= $index ?>">
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="car-detail-right">
            <div class="car-detail-info">
                <div class="car-detail-header">
                    <div class="car-title-rating">
                        <h1><?= $car['brand'] ?> <?= isset($car['type']) ? '- ' . $car['type'] : '' ?></h1>
                        <div class="car-rating">
                            <div class="stars stars-<?= count($carReviews) > 0 ? min(5, round(array_sum(array_column($carReviews, 'rating')) / count($carReviews))) : 0 ?>"></div>
                            <span class="review-count"><?= count($carReviews) ?> Beoordelingen</span>
                        </div>
                    </div>
                    <!-- Like button removed as requested -->
                </div>
                
                <div class="car-description">
                    <p><?= isset($car['description']) ? $car['description'] : 'No description available.' ?></p>
                </div>
                
                <div class="car-specs-grid">
                    <div class="car-spec">
                        <span class="spec-label">Type Auto</span>
                        <span class="spec-value"><?= isset($car['type']) ? $car['type'] : 'N/A' ?></span>
                    </div>
                    <div class="car-spec">
                        <span class="spec-label">Capaciteit</span>
                        <span class="spec-value"><?= isset($car['capacity']) ? $car['capacity'] : 'N/A' ?></span>
                    </div>
                    <div class="car-spec">
                        <span class="spec-label">Besturing</span>
                        <span class="spec-value"><?= isset($car['steering']) ? $car['steering'] : 'N/A' ?></span>
                    </div>
                    <div class="car-spec">
                        <span class="spec-label">Brandstof</span>
                        <span class="spec-value"><?= isset($car['gasoline']) ? $car['gasoline'] : 'N/A' ?></span>
                    </div>
                </div>
                
                <div class="car-pricing">
                    <div class="price-info">
                        <div class="current-price">€<?= isset($car['price']) ? $car['price'] : '0,00' ?><span class="price-period">/dag</span></div>
                        <div class="old-price">€<?= isset($car['old_price']) ? $car['old_price'] : '0,00' ?></div>
                    </div>
                </div>
                
                <div class="reservation-form">
                    <h3>Reserveer deze auto</h3>
                    <?php if(!isset($_SESSION['id'])): ?>
                        <div class="login-notice">
                            <p>U moet ingelogd zijn om een reservering te maken</p>
                            <a href="/login-form" class="button-secondary">Inloggen</a>
                            <a href="/register-form" class="button-primary small">Account aanmaken</a>
                        </div>
                    <?php else: ?>
                        <form action="/create-reservation" method="post">
                            <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                            <input type="hidden" name="price_per_day" value="<?= isset($car['price']) ? $car['price'] : '0,00' ?>">
                            
                            <div class="form-row">
                                <div class="form-group half">
                                    <label for="pickup_date">Ophaaldatum</label>
                                    <input type="date" id="pickup_date" name="pickup_date" required min="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group half">
                                    <label for="return_date">Retourdatum</label>
                                    <input type="date" id="return_date" name="return_date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Geschatte kosten</label>
                                <div class="cost-estimate">
                                    <span id="total_days">0</span> dagen x €<?= isset($car['price']) ? $car['price'] : '0,00' ?> = €<span id="total_cost">0,00</span>
                                </div>
                            </div>
                            
                            <button type="submit" class="rent-now-button full-width">Reservering bevestigen</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="reviews-section">
        <div class="reviews-header">
            <h2>Beoordelingen</h2>
            <span class="review-count"><?= count($carReviews) ?></span>
        </div>
        
        <div class="reviews-list">
            <?php if(count($carReviews) > 0): ?>
                <?php foreach($carReviews as $review): ?>
                <div class="review-item">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">
                            <?php
                            $profileImage = 'assets/images/avatars/avatar-placeholder.jpg';
                            if (isset($_SESSION['id'], $_SESSION['email']) && $review['name'] === $_SESSION['email']) {
                                // Haal profielfoto op zoals in header.php
                                $profile_stmt = $conn->prepare("SELECT profile_image FROM account WHERE id = :id");
                                $profile_stmt->bindParam(":id", $_SESSION['id']);
                                $profile_stmt->execute();
                                $profile_data = $profile_stmt->fetch(PDO::FETCH_ASSOC);
                                if (!empty($profile_data['profile_image'])) {
                                    $profileImage = '/' . $profile_data['profile_image'];
                                } else {
                                    $profileImage = '/assets/images/profil.png';
                                }
                            }
                            ?>
                            <img src="<?= $profileImage ?>" alt="<?= $review['name'] ?>">
                        </div>
                        <div class="reviewer-details">
                            <h3><?= $review['name'] ?></h3>
                            <p><?= $review['position'] ?></p>
                        </div>
                        <div class="review-date"><?= $review['date'] ?></div>
                    </div>
                    <div class="review-rating">
                        <div class="stars stars-<?= (int)$review['rating'] ?>"></div>
                    </div>
                    <div class="review-content">
                        <p><?= $review['comment'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-reviews">Nog geen beoordelingen. Wees de eerste om deze auto te beoordelen!</div>
            <?php endif; ?>
        </div>
        
        <?php if(count($carReviews) > 3): ?>
        <div class="show-all-reviews">
            <button class="show-all-button">Toon Alles <i class="fa fa-chevron-down"></i></button>
        </div>
        <?php endif; ?>
        
        <div class="add-review-section">
            <h3>Voeg Uw Beoordeling Toe</h3>
            <form action="/add-review" method="post" class="review-form">
                <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                
                <div class="form-group">
                    <label for="name">Uw Naam</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="position">Uw Functie</label>
                    <input type="text" id="position" name="position" placeholder="bijv. CEO bij Bedrijf" required>
                </div>
                
                <div class="form-group">
                    <label>Beoordeling</label>
                    <div class="rating-input">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" <?= $i === 5 ? 'checked' : '' ?>>
                        <label for="star<?= $i ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="comment">Uw Beoordeling</label>
                    <textarea id="comment" name="comment" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="submit-review-btn">Submit Review</button>
            </form>
        </div>
    </div>
</main>

<!-- JavaScript for like functionality removed as requested -->

<?php if (isset($_SESSION['reservation_error'])): ?>
<script>
    // Show reservation error
    alert('<?= $_SESSION['reservation_error'] ?>');
</script>
<?php unset($_SESSION['reservation_error']); ?>
<?php endif; ?>

<script>
    // Calculate total cost for reservation
    document.addEventListener('DOMContentLoaded', function() {
        const pickupDateInput = document.getElementById('pickup_date');
        const returnDateInput = document.getElementById('return_date');
        const totalDaysSpan = document.getElementById('total_days');
        const totalCostSpan = document.getElementById('total_cost');
        const pricePerDay = <?= isset($car['price']) ? $car['price'] : '0' ?>;

        function calculateTotal() {
            if (pickupDateInput.value && returnDateInput.value) {
                const pickupDate = new Date(pickupDateInput.value);
                const returnDate = new Date(returnDateInput.value);
                
                if (returnDate > pickupDate) {
                    const diffTime = Math.abs(returnDate - pickupDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    totalDaysSpan.textContent = diffDays;
                    totalCostSpan.textContent = (diffDays * pricePerDay).toFixed(2).replace('.', ',');
                } else {
                    totalDaysSpan.textContent = '0';
                    totalCostSpan.textContent = '0,00';
                }
            }
        }

        pickupDateInput?.addEventListener('change', calculateTotal);
        returnDateInput?.addEventListener('change', calculateTotal);
        
        // Set min date for return date to be at least one day after pickup date
        pickupDateInput?.addEventListener('change', function() {
            if (pickupDateInput.value) {
                const nextDay = new Date(pickupDateInput.value);
                nextDay.setDate(nextDay.getDate() + 1);
                
                const year = nextDay.getFullYear();
                const month = String(nextDay.getMonth() + 1).padStart(2, '0');
                const day = String(nextDay.getDate()).padStart(2, '0');
                
                returnDateInput.min = `${year}-${month}-${day}`;
                
                // If current return date is before new min date, update it
                if (returnDateInput.value && new Date(returnDateInput.value) < nextDay) {
                    returnDateInput.value = `${year}-${month}-${day}`;
                    calculateTotal();
                }
            }
        });
    });
</script>

<?php require "includes/footer.php" ?>
