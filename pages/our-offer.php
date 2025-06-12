<?php 
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../database/connection.php';

// Get search term
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Get filters
$priceMin = isset($_GET['price_min']) ? (int)$_GET['price_min'] : 0;
$priceMax = isset($_GET['price_max']) ? (int)$_GET['price_max'] : 1000;
$transmission = isset($_GET['transmission']) ? $_GET['transmission'] : '';
$carTypeFilters = isset($_GET['car_type']) ? (array)$_GET['car_type'] : [];
$capacityFilters = isset($_GET['capacity']) ? (array)$_GET['capacity'] : [];

// Build WHERE clause
$whereConditions = ["price BETWEEN ? AND ?"];
$params = [$priceMin, $priceMax];

if ($transmission) {
    $whereConditions[] = "transmission = ?";
    $params[] = $transmission;
}

if (!empty($carTypeFilters)) {
    $placeholders = implode(', ', array_fill(0, count($carTypeFilters), '?'));
    $whereConditions[] = "type IN ($placeholders)";
    $params = array_merge($params, $carTypeFilters);
}

if (!empty($capacityFilters)) {
    $capacityConditions = [];
    foreach ($capacityFilters as $capacity) {
        if ($capacity === '8+') {
            $capacityConditions[] = "capacity >= 8";
        } else {
            $capacityConditions[] = "capacity = ?";
            $params[] = (int)$capacity;
        }
    }
    $whereConditions[] = "(" . implode(" OR ", $capacityConditions) . ")";
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

// Fetch cars with filters and search term
$stmt = $conn->prepare("SELECT * FROM cars $whereClause ORDER BY category, brand");
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch unique values for filters
$stmt = $conn->prepare("SELECT DISTINCT type FROM cars ORDER BY type");
$stmt->execute();
$carTypes = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $conn->prepare("SELECT DISTINCT capacity FROM cars ORDER BY capacity");
$stmt->execute();
$capacities = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Group cars by category (though not explicitly used in the new layout, keeping for potential future use or existing data)
$carsByCategory = [];
foreach ($cars as $car) {
    $carsByCategory[$car['category']][] = $car;
}
?>

<main class="our-offer-page">
    <div class="filters-sidebar">
        <form action="/our-offer" method="GET">
            <h2>TYPE</h2>
            <div class="filter-group">
                <div class="filter-options">
                    <?php foreach ($carTypes as $type): ?>
                        <div>
                            <input type="checkbox" id="type-<?= htmlspecialchars($type) ?>" name="car_type[]" value="<?= htmlspecialchars($type) ?>" <?= in_array($type, $carTypeFilters) ? 'checked' : '' ?>>
                            <label for="type-<?= htmlspecialchars($type) ?>"><span><?= htmlspecialchars($type) ?> <span class="count">(<?= count(array_filter($cars, fn($car) => $car['type'] === $type)) ?>)</span></span></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <h2>CAPACITY</h2>
            <div class="filter-group">
                <div class="filter-options">
                    <?php foreach ($capacities as $capacity): ?>
                        <div>
                            <input type="checkbox" id="capacity-<?= htmlspecialchars($capacity) ?>" name="capacity[]" value="<?= htmlspecialchars($capacity) ?>" <?= in_array($capacity, $capacityFilters) ? 'checked' : '' ?>>
                            <label for="capacity-<?= htmlspecialchars($capacity) ?>"><span><?= htmlspecialchars($capacity) ?> Person <span class="count">(<?= count(array_filter($cars, fn($car) => $car['capacity'] == $capacity)) ?>)</span></span></label>
                        </div>
                    <?php endforeach; ?>
                     <div>
                        <input type="checkbox" id="capacity-8-plus" name="capacity[]" value="8+" <?= in_array('8+', $capacityFilters) ? 'checked' : '' ?>>
                        <label for="capacity-8-plus"><span>8 or More <span class="count">(<?= count(array_filter($cars, fn($car) => $car['capacity'] >= 8)) ?>)</span></span></label>
                    </div>
                </div>
            </div>

            <h2>PRICE</h2>
            <div class="filter-group">
                <div class="price-range-slider">
                    <div class="range-slider-fill" style="left: <?= ($priceMin / 1000) * 100 ?>%; width: <?= (($priceMax - $priceMin) / 1000) * 100 ?>%;"></div>
                    <input type="range" class="range-slider-handle" min="0" max="1000" value="<?= $priceMin ?>" name="price_min">
                    <input type="range" class="range-slider-handle" min="0" max="1000" value="<?= $priceMax ?>" name="price_max">
                </div>
                <div class="price-display">
                    <span>Max. $<?= $priceMax ?>.00</span>
                </div>
            </div>
            <button type="submit" class="button-primary" style="width: 100%;">Apply Filter</button>
        </form>
    </div>

    <div class="cars-listing">
        <div class="search-and-filter-bar">
            <form action="/our-offer" method="GET" class="search-form">
                <input type="search" name="q" id="search" placeholder="Search something here" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="search-button">
                    <img src="assets/images/icons/search-normal.svg" alt="Search">
                </button>
            </form>
            <button class="filter-button">
                <img src="assets/images/icons/filter.svg" alt="Filter">
                Filter
            </button>
        </div>

        <div class="car-grid">
            <?php foreach ($cars as $car): ?>
                <div class="car-card">
                    <h3><?= htmlspecialchars($car['brand']) ?> - <?= htmlspecialchars($car['model']) ?></h3>
                    <span class="car-type"><?= htmlspecialchars($car['type']) ?></span>
                    <img src="/assets/images/icons/favorite.svg" alt="Favorite" class="favorite-icon">
                    <div class="car-image-container">
                        <img src="/<?= ltrim(htmlspecialchars($car['image_url']), '/') ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                    </div>
                    <div class="car-specs-grid">
                        <div>
                            <img src="assets/images/icons/gas-station.svg" alt="Fuel">
                            <span><?= htmlspecialchars($car['fuel_capacity']) ?>L</span>
                        </div>
                        <div>
                            <img src="assets/images/icons/car.svg" alt="Transmission">
                            <span><?= htmlspecialchars($car['transmission']) ?></span>
                        </div>
                        <div>
                            <img src="assets/images/icons/profile-2user.svg" alt="Capacity">
                            <span><?= htmlspecialchars($car['capacity']) ?> People</span>
                        </div>
                    </div>
                    <div class="car-price-section">
                        <div class="price-info">
                            <span class="current-price">$<?= number_format($car['price'], 2) ?>/<span>day</span></span>
                            <?php if (isset($car['old_price'])): ?>
                                <span class="old-price">$<?= number_format($car['old_price'], 2) ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="/car-detail?id=<?= $car['id'] ?>" class="rent-button">Rent Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="show-more-button">Show more car</button>
    </div>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

