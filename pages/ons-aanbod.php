<?php require __DIR__ . "/../includes/header.php" ?>

<?php
// Hulpfuncties voor de pagina
function getFilters() {
    // Haal de geselecteerde filters op
    $selectedFilters = isset($_GET['filters']) ? $_GET['filters'] : [];
    
    // Verwerk specifieke filtertype uit URL parameters
    if (isset($_GET['type'])) {
        if ($_GET['type'] === 'bedrijfswagen') {
            $selectedFilters = ['SUV', 'Bedrijfsbus'];
        } elseif ($_GET['type'] === 'regular') {
            $selectedFilters = ['Sport', 'Sedan', 'Hatchback'];
        }
    }
    
    return $selectedFilters;
}

function getCars($conn) {
    // Haal filter parameters op
    $selectedFilters = getFilters();
    $typeFilter = isset($_GET['type']) ? $_GET['type'] : null;
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
    
    $params = [];
    $conditions = [];
    
    // Filter op voertuigtype
    if ($typeFilter === 'bedrijfswagen') {
        $conditions[] = "type IN ('SUV', 'Bedrijfsbus')";
    } elseif ($typeFilter === 'regular') {
        $conditions[] = "type NOT IN ('SUV', 'Bedrijfsbus')";
    } elseif (!empty($selectedFilters)) {
        $placeholders = str_repeat('?,', count($selectedFilters) - 1) . '?';
        $conditions[] = "type IN ($placeholders)";
        $params = array_merge($params, $selectedFilters);
    }
    
    // Filter op zoekterm
    if (!empty($searchTerm)) {
        $conditions[] = "(brand LIKE ? OR type LIKE ? OR description LIKE ?)";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
    }
    
    // Query uitvoeren
    if (!empty($conditions)) {
        $whereClause = " WHERE " . implode(" AND ", $conditions);
        $sql = "SELECT DISTINCT * FROM cars" . $whereClause;
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
    } else {
        $stmt = $conn->query("SELECT DISTINCT * FROM cars");
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Database verbinding maken
require_once __DIR__ . "/../database/connection.php";

// Data ophalen
try {
    $selectedFilters = getFilters();
    $cars = getCars($conn);
    $autoTypes = [  // Beschikbare autotypes
        'Sport' => 'Sport',
        'SUV' => 'SUV',
        'Sedan' => 'Sedan',
        'Hatchback' => 'Hatchback',
        'Bedrijfsbus' => 'Bedrijfsbus'
    ];
} catch (PDOException $e) {
    echo "<div class='message'>Database error: " . $e->getMessage() . "</div>";
    $cars = [];
    $selectedFilters = [];
}
?>

<main class="aanbod-page">
    <div class="aanbod-container">
        <!-- Filter sidebar -->
        <div class="filters-sidebar sticky-sidebar">
            <form id="filter-form" method="get" action="/ons-aanbod">
                <div class="filter-section">
                    <h3>TYPE</h3>
                    <div class="filter-options">
                        <?php foreach (
                            $autoTypes as $value => $label): ?>
                            <div class="filter-option">
                                <input type="checkbox" 
                                       id="type-<?= strtolower($value) ?>" 
                                       name="filters[]" 
                                       value="<?= $value ?>" 
                                       class="car-type-filter"
                                       <?= in_array($value, $selectedFilters) ? 'checked' : '' ?>>
                                <label for="type-<?= strtolower($value) ?>"><?= $label ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="button-primary">Filters toepassen</button>
                    <a href="/ons-aanbod" class="button-secondary">Reset filters</a>
                </div>
            </form>
        </div>
        <!-- Auto overzicht -->
        <div class="car-listings">
            <div class="listings-header">
                <h2>Ons Aanbod</h2>
                <div class="search-container">
                    <form action="" method="get" class="search-form">
                        <input type="text" name="search" placeholder="Zoek op merk, type..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                        
                        <?php // Behoud geselecteerde filters in zoekopdracht
                        if (!empty($selectedFilters)) {
                            foreach ($selectedFilters as $filter) {
                                echo "<input type='hidden' name='filters[]' value='" . htmlspecialchars($filter) . "'>";
                            }
                        }
                        
                        if (isset($_GET['type'])) {
                            echo "<input type='hidden' name='type' value='" . htmlspecialchars($_GET['type']) . "'>";
                        }
                        ?>
                    </form>
                </div>
            </div>

            <!-- Autoweergave -->
            <div class="car-grid">
                <?php foreach ($cars as $car): ?>
                <div class="car-card">
                    <div class="car-header">
                        <div class="car-info">
                            <h3><?= $car['brand'] ?></h3>
                            <span class="car-type"><?= $car['type'] ?></span>
                        </div>
                        <div class="favorite-icon <?= isset($car['is_favorite']) && $car['is_favorite'] ? 'active' : '' ?>" data-car-id="<?= $car['id'] ?>">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    <div class="car-image">
                        <img src="assets/images/products/<?= $car['main_image'] ?>" alt="<?= $car['brand'] ?>">
                    </div>
                    <div class="car-specs">
                        <div class="spec-item">
                            <img src="assets/images/icons/gas-station.svg" alt="Brandstof">
                            <span><?= $car['gasoline'] ?></span>
                        </div>
                        <div class="spec-item">
                            <img src="assets/images/icons/car.svg" alt="Handmatig">
                            <span><?= $car['steering'] ?></span>
                        </div>
                        <div class="spec-item">
                            <img src="assets/images/icons/profile-2user.svg" alt="Personen">
                            <span><?= $car['capacity'] ?></span>
                        </div>
                    </div>
                    <div class="car-footer">
                        <div class="price">
                            <span class="amount">€<?= number_format((float)$car['price'], 2, ',', '.') ?></span>
                            <span class="period">/dag</span>
                        </div>
                        <a href="/car-detail?id=<?= $car['id'] ?>" class="rent-now-btn">Huur Nu</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<style>
    .aanbod-container {
        display: flex;
        flex-direction: row;
        gap: 0;
        align-items: stretch;
    }
    .filters-sidebar {
        order: 0;
        margin-left: 0;
        margin-right: 32px;
        min-width: 260px;
        max-width: 320px;
        background: white;
        border-radius: 0 16px 16px 0;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        padding: 32px 24px 32px 24px;
        height: calc(100vh - 0px);
        position: sticky;
        top: 0;
        bottom: 0;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .sticky-sidebar {
        position: sticky;
        top: 0;
        align-self: flex-start;
        height: calc(100vh - 0px);
    }
    .car-listings {
        flex: 1;
        margin-right: 0;
    }
    @media (max-width: 1100px) {
        .aanbod-container {
            flex-direction: column;
        }
        .filters-sidebar {
            margin-right: 0;
            margin-bottom: 24px;
            border-radius: 16px;
            max-width: 100%;
            width: 100%;
            position: static;
            height: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    }
    @media (max-width: 768px) {
        .aanbod-container {
            flex-direction: column;
        }
        .filters-sidebar {
            margin-right: 0;
            margin-bottom: 20px;
            border-radius: 12px;
            max-width: 100%;
            width: 100%;
            position: static;
            height: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 20px 12px;
        }
    }
    /* Zoekbalk styling */
    .listings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .search-container {
        margin-left: auto;
    }
    
    .search-form {
        display: flex;
        position: relative;
    }
    
    .search-form input[type="text"] {
        width: 280px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .search-form input[type="text"]:focus {
        border-color: #3563E9;
        box-shadow: 0 0 0 2px rgba(53, 99, 233, 0.2);
        outline: none;
    }
    
    .search-button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    
    .search-button:hover {
        color: #3563E9;
    }
    
    /* Responsieve styling */
    @media (max-width: 768px) {
        .listings-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-container {
            width: 100%;
            margin-top: 15px;
            margin-left: 0;
        }
        
        .search-form input[type="text"] {
            width: 100%;
        }
    }
    .filter-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 18px;
    }
    .filter-actions .button-primary,
    .filter-actions .button-secondary {
        width: 100%;
        margin: 0;
        box-sizing: border-box;
        padding: 16px 0;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.13rem;
        display: block;
        text-align: center;
    }
</style>

<?php require __DIR__ . "/../includes/footer.php" ?>
