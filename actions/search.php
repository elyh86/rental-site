<?php
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../database/connection.php";

// Initialize variables
$search = '';
$cars = [];
$error = '';

// Haal de zoekterm op en maak deze veilig
if (isset($_GET['q'])) {
    $search = trim($_GET['q']);
    
    if (!empty($search)) {
        try {
            // Bouw de zoek query
            $query = "SELECT * FROM cars 
                     WHERE (
                         LOWER(brand) LIKE LOWER(:search) 
                         OR LOWER(model) LIKE LOWER(:search)
                         OR LOWER(CONCAT(brand, ' ', model)) LIKE LOWER(:search)
                         OR LOWER(type) LIKE LOWER(:search)
                         OR LOWER(category) LIKE LOWER(:search)
                     )";

            $stmt = $conn->prepare($query);
            $searchTerm = "%{$search}%";
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();

            $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = 'Er is een fout opgetreden bij het zoeken. Probeer het later opnieuw.';
        }
    } else {
        header('Location: /');
        exit;
    }
} else {
    header('Location: /');
    exit;
}
?>
<link rel="stylesheet" href="/assets/css/search.css">

<main class="search-results" style="max-width: 900px; margin: 2rem auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px rgba(53,99,233,0.08); padding: 2rem 2.5rem;">
    <h2 class="section-title" style="font-size:2rem; color:#3563e9; margin-bottom:1.5rem;">Zoekresultaten voor "<?= htmlspecialchars($search) ?>"</h2>
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <p><?= htmlspecialchars($error) ?></p>
            <a href="/" class="button-primary">Terug naar home</a>
        </div>
    <?php elseif (count($cars) > 0): ?>
        <p class="results-count" style="color:#7ca6c3; margin-bottom:1.5rem;"><?= count($cars) ?> auto's gevonden</p>
        <div class="cars-grid">
            <?php foreach ($cars as $car): ?>
                <div class="car-card">
                    <div class="car-image">
                        <img src="/<?php echo ltrim(htmlspecialchars($car['image_url']), '/'); ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                        <?php if ($car['is_available']): ?>
                            <span class="availability available">Beschikbaar</span>
                        <?php else: ?>
                            <span class="availability unavailable">Niet beschikbaar</span>
                        <?php endif; ?>
                    </div>
                    <div class="car-info">
                        <h3><?= htmlspecialchars($car['brand']) ?></h3>
                        <p class="car-description"><?= htmlspecialchars($car['description'] ?? '') ?></p>
                        <div class="car-specs">
                            <span><img src="/assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($car['fuel_capacity']) ?></span>
                            <span><img src="/assets/images/icons/car.svg" alt=""><?= htmlspecialchars($car['transmission']) ?></span>
                            <span><img src="/assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($car['capacity']) ?></span>
                            <?php if (isset($car['luggage_capacity'])): ?>
                                <span><img src="/assets/images/icons/luggage.svg" alt=""><?= htmlspecialchars($car['luggage_capacity']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="car-price">
                            <span class="price">€<?= number_format($car['price'], 2, ',', '.') ?></span>
                            <span class="period">per dag</span>
                            <?php if (isset($car['weekly_price'])): ?>
                                <span class="weekly-price">€<?= number_format($car['weekly_price'], 2, ',', '.') ?> per week</span>
                            <?php endif; ?>
                        </div>
                        <a href="/car-detail?id=<?= $car['id'] ?>" class="button-primary">Bekijk details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-results">
            <h2>Geen auto's gevonden</h2>
            <p>Probeer andere zoektermen of bekijk alle beschikbare auto's.</p>
            <a href="/ons-aanbod" class="button-primary">Bekijk alle auto's</a>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . "/../includes/footer.php"; ?>
