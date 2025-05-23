<?php 
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../database/connection.php';

// Zoekterm ophalen
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Filters ophalen
$priceMin = isset($_GET['price_min']) ? (int)$_GET['price_min'] : 0;
$priceMax = isset($_GET['price_max']) ? (int)$_GET['price_max'] : 1000;
$transmission = isset($_GET['transmission']) ? $_GET['transmission'] : '';

// WHERE-clausule opbouwen
$whereConditions = ["price BETWEEN ? AND ?"];
$params = [$priceMin, $priceMax];

if ($transmission) {
    $whereConditions[] = "transmission = ?";
    $params[] = $transmission;
}

if ($search) {
    $whereConditions[] = "(
        LOWER(brand) LIKE LOWER(?) 
        OR LOWER(model) LIKE LOWER(?) 
        OR LOWER(CONCAT(brand, ' ', model)) LIKE LOWER(?) 
        OR LOWER(type) LIKE LOWER(?) 
        OR LOWER(category) LIKE LOWER(?)
    )";
    for ($i = 0; $i < 5; $i++) {
        $params[] = "%$search%";
    }
}

$whereClause = !empty($whereConditions) ? "WHERE " . implode(" AND ", $whereConditions) : "";

// Haal auto's op met filters en zoekterm
$stmt = $conn->prepare("SELECT * FROM cars $whereClause ORDER BY category, brand");
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Haal unieke categorieën op en sorteer ze
$categoryOrder = [
    'Compact' => 1,
    'Sedan' => 2,
    'SUV' => 3,
    'Luxe' => 4,
    'Bedrijfswagen' => 5,
    'Transport' => 6
];
$categories = [];
foreach ($cars as $car) {
    if (!in_array($car['category'], $categories)) {
        $categories[] = $car['category'];
    }
}
usort($categories, function($a, $b) use ($categoryOrder) {
    return ($categoryOrder[$a] ?? 999) - ($categoryOrder[$b] ?? 999);
});

// Haal unieke waarden op voor filters
$stmt = $conn->prepare("SELECT DISTINCT transmission FROM cars ORDER BY transmission");
$stmt->execute();
$transmissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Groepeer auto's per categorie
$carsByCategory = [];
foreach ($cars as $car) {
    $carsByCategory[$car['category']][] = $car;
}
?>

<main class="our-offer-page">
    <h1 class="page-title">Ons Aanbod</h1>
    
    <div class="filters-container">
        <form action="/ons-aanbod" method="GET" class="filters-form">
            <div class="filter-group">
                <label>Prijs per dag</label>
                <div class="price-range">
                    <input type="number" name="price_min" value="<?= $priceMin ?>" min="0" max="1000" step="10" placeholder="Min">
                    <span>-</span>
                    <input type="number" name="price_max" value="<?= $priceMax ?>" min="0" max="1000" step="10" placeholder="Max">
                </div>
            </div>
            <div class="filter-group">
                <label>Transmissie</label>
                <select name="transmission">
                    <option value="">Alle</option>
                    <?php foreach ($transmissions as $trans): ?>
                        <option value="<?= htmlspecialchars($trans) ?>" <?= $transmission === $trans ? 'selected' : '' ?>>
                            <?= htmlspecialchars($trans) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="button-primary">Filter toepassen</button>
            <?php if ($priceMin > 0 || $priceMax < 1000 || $transmission): ?>
                <a href="/ons-aanbod" class="button-secondary">Filters wissen</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="category-filters">
        <?php foreach ($categories as $category): ?>
            <a href="#<?= htmlspecialchars(strtolower(str_replace(' ', '-', $category))) ?>" 
               class="category-filter">
                <?= htmlspecialchars($category) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php foreach ($categories as $category): ?>
        <section id="<?= htmlspecialchars(strtolower(str_replace(' ', '-', $category))) ?>" class="category-section">
            <h2 class="category-title"><?= htmlspecialchars($category) ?></h2>
            <div class="cars-grid">
                <?php foreach ($carsByCategory[$category] as $car): ?>
                    <?php
                    // Check of de auto nu verhuurd is
                    $stmt = $conn->prepare("SELECT COUNT(*) FROM rentals WHERE car_id = :car_id AND start_date <= CURDATE() AND end_date >= CURDATE()");
                    $stmt->execute([':car_id' => $car['id']]);
                    $isRented = $stmt->fetchColumn() > 0;
                    ?>
                    <div class="car-card<?= $isRented ? ' car-unavailable' : '' ?>">
                        <div class="car-image">
                            <img src="/<?= ltrim(htmlspecialchars($car['image_url']), '/') ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                            <?php if ($isRented): ?>
                                <span class="availability unavailable">Niet beschikbaar</span>
                            <?php elseif ($car['is_available']): ?>
                                <span class="availability available">Beschikbaar</span>
                            <?php else: ?>
                                <span class="availability unavailable">Niet beschikbaar</span>
                            <?php endif; ?>
                        </div>
                        <div class="car-info">
                            <h3><?= htmlspecialchars($car['brand']) ?></h3>
                            <p class="car-description"><?= htmlspecialchars($car['description'] ?? '') ?></p>
                            <div class="car-specs">
                                <span><img src="assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($car['fuel_capacity']) ?></span>
                                <span><img src="assets/images/icons/car.svg" alt=""><?= htmlspecialchars($car['transmission']) ?></span>
                                <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($car['capacity']) ?></span>
                                <?php if (isset($car['luggage_capacity'])): ?>
                                    <span><img src="assets/images/icons/luggage.svg" alt=""><?= htmlspecialchars($car['luggage_capacity']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="car-features">
                                <?php if (isset($car['features'])): ?>
                                    <?php foreach (explode(',', $car['features']) as $feature): ?>
                                        <span class="feature-tag"><?= htmlspecialchars(trim($feature)) ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="car-price">
                                <span class="price<?= $isRented ? ' price-unavailable' : '' ?>">€<?= number_format($car['price'], 2, ',', '.') ?></span>
                                <span class="period">per dag</span>
                                <?php if ($isRented): ?>
                                    <span class="not-available-text">Niet beschikbaar</span>
                                <?php elseif (isset($car['weekly_price'])): ?>
                                    <span class="weekly-price">€<?= number_format($car['weekly_price'], 2, ',', '.') ?> per week</span>
                                <?php endif; ?>
                            </div>
                            <div class="car-actions">
                                <a href="/car-detail?id=<?= $car['id'] ?>" class="button-primary">Bekijk details</a>
                                <?php if ($isRented): ?>
                                    <a href="#" class="button-primary huur-disabled" tabindex="-1" aria-disabled="true" style="pointer-events:none;opacity:0.5;">Huur nu</a>
                                <?php else: ?>
                                    <a href="#" class="button-primary" data-huur-auto-id="<?= $car['id'] ?>">Huur nu</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

