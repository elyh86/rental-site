<?php
require_once __DIR__ . '/../config/database.php';

// Haal alle unieke categorieën op
$categories_query = "SELECT DISTINCT category FROM cars ORDER BY category";
$categories_result = $conn->query($categories_query);
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Haal alle unieke capaciteiten op
$capacities_query = "SELECT DISTINCT capacity FROM cars ORDER BY capacity";
$capacities_result = $conn->query($capacities_query);
$capacities = [];
while ($row = $capacities_result->fetch_assoc()) {
    $capacities[] = $row['capacity'];
}

// Filter logica
$where_conditions = [];
$params = [];
$types = "";

if (isset($_GET['type']) && !empty($_GET['type'])) {
    $where_conditions[] = "type = ?";
    $params[] = $_GET['type'];
    $types .= "s";
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $where_conditions[] = "category = ?";
    $params[] = $_GET['category'];
    $types .= "s";
}

if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
    $where_conditions[] = "price >= ?";
    $params[] = $_GET['min_price'];
    $types .= "d";
}

if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
    $where_conditions[] = "price <= ?";
    $params[] = $_GET['max_price'];
    $types .= "d";
}

if (isset($_GET['capacity']) && !empty($_GET['capacity'])) {
    $where_conditions[] = "capacity = ?";
    $params[] = $_GET['capacity'];
    $types .= "s";
}

// Basis query
$query = "SELECT * FROM cars WHERE is_available = 1";

// Voeg filters toe als ze bestaan
if (!empty($where_conditions)) {
    $query .= " AND " . implode(" AND ", $where_conditions);
}

$query .= " ORDER BY price ASC";

// Prepare en execute de query
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ons Aanbod - Auto Verhuur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Filters</h5>
                        <form method="GET" action="/our-offer">
                            <!-- Type Filter -->
                            <div class="mb-3">
                                <label class="form-label">Type Auto</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type_all" value="" <?php echo !isset($_GET['type']) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="type_all">Alle types</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type_regular" value="regular" <?php echo isset($_GET['type']) && $_GET['type'] === 'regular' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="type_regular">Regular</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type_business" value="business" <?php echo isset($_GET['type']) && $_GET['type'] === 'business' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="type_business">Business</label>
                                </div>
                            </div>

                            <!-- Categorie Filter -->
                            <div class="mb-3">
                                <label class="form-label">Categorie</label>
                                <select class="form-select" name="category">
                                    <option value="">Alle categorieën</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo htmlspecialchars($category); ?>" <?php echo isset($_GET['category']) && $_GET['category'] === $category ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Prijs Range Filter -->
                            <div class="mb-3">
                                <label class="form-label">Prijs per dag</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" class="form-control" name="min_price" placeholder="Min" value="<?php echo isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : ''; ?>">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="max_price" placeholder="Max" value="<?php echo isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : ''; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Capaciteit Filter -->
                            <div class="mb-3">
                                <label class="form-label">Aantal personen</label>
                                <select class="form-select" name="capacity">
                                    <option value="">Alle capaciteiten</option>
                                    <?php foreach ($capacities as $capacity): ?>
                                        <option value="<?php echo htmlspecialchars($capacity); ?>" <?php echo isset($_GET['capacity']) && $_GET['capacity'] === $capacity ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($capacity); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Filter toepassen</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Auto Grid -->
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php while ($car = $result->fetch_assoc()): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h5>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($car['category']); ?> | 
                                            <?php echo htmlspecialchars($car['capacity']); ?> | 
                                            <?php echo htmlspecialchars($car['transmission']); ?>
                                        </small>
                                    </p>
                                    <p class="card-text"><?php echo htmlspecialchars($car['description']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="h5 mb-0">€<?php echo number_format($car['price'], 2); ?></span>
                                            <?php if ($car['original_price']): ?>
                                                <small class="text-muted text-decoration-line-through">€<?php echo number_format($car['original_price'], 2); ?></small>
                                            <?php endif; ?>
                                            <small class="d-block text-muted">per dag</small>
                                        </div>
                                        <a href="/rent-car?id=<?php echo $car['id']; ?>" class="btn btn-primary">Huren</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
