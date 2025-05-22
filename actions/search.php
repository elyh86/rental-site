<?php
require_once __DIR__ . "/../includes/header.php";

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
                     WHERE is_available = 1
                     AND (
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

<main class="search-results">
    <div class="search-form-container">
        <form action="/actions/search.php" method="GET" class="search-form">
            <input type="search" name="q" placeholder="Zoek op merk, model of type..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="search-button">
                <img src="/assets/images/icons/search.svg" alt="Zoeken" class="search-icon">
            </button>
        </form>
    </div>
    <h2 class="section-title">Zoekresultaten voor "<?= htmlspecialchars($search) ?>"</h2>
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <p><?= htmlspecialchars($error) ?></p>
            <a href="/" class="button-primary">Terug naar home</a>
        </div>
    <?php elseif (count($cars) > 0): ?>
        <p class="results-count"><?= count($cars) ?> auto's gevonden</p>
        <div class="cars">
            <?php foreach ($cars as $car): ?>
                <div class="car-details">
                    <div class="car-brand">
                        <h3><?= htmlspecialchars($car['brand']) ?></h3>
                        <div class="car-type">
                            <?= htmlspecialchars($car['category']) ?>
                        </div>
                    </div>
                    <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                    <div class="car-specification">
                        <span><img src="/assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($car['fuel_capacity']) ?></span>
                        <span><img src="/assets/images/icons/car.svg" alt=""><?= htmlspecialchars($car['transmission']) ?></span>
                        <span><img src="/assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($car['capacity']) ?></span>
                    </div>
                    <div class="rent-details">
                        <?php if ($car['original_price']): ?>
                            <span class="original-price">€<?= number_format($car['original_price'], 2, ',', '.') ?></span>
                        <?php endif; ?>
                        <span><span class="font-weight-bold">€<?= number_format($car['price'], 2, ',', '.') ?></span> / dag</span>
                        <a href="/car-detail?id=<?= $car['id'] ?>" class="button-primary">Bekijk nu</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-results">
            <h2>Geen auto's gevonden</h2>
            <p>Probeer andere zoektermen of bekijk alle beschikbare auto's.</p>
            <a href="/" class="button-primary">Terug naar home</a>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . "/../includes/footer.php"; ?>
