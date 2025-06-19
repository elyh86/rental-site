<?php
session_start();
require __DIR__ . "/../includes/header.php";

// Check if user is logged in and has admin role
if (!isset($_SESSION['id'])) {
    header('Location: /login-form');
    exit();
}

// For now, we'll use a simple admin check - you can enhance this later
$admin_emails = ['admin@example.com', 'admin@rydr.nl', 'lllk@gmail.com']; // Add admin emails here
if (!in_array($_SESSION['email'], $admin_emails)) {
    echo '<div class="message">U heeft geen toegang tot deze pagina.</div>';
    exit();
}

// Get cars from database
require_once __DIR__ . "/../database/connection.php";

try {
    $stmt = $conn->query("SELECT * FROM cars ORDER BY created_at DESC");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    $cars = [];
}
?>

<main class="admin-main">
    <div class="admin-container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Beheer het wagenpark van Rydr</p>
        </div>

        <?php if (isset($_SESSION['admin_success'])): ?>
            <div class="succes-message">
                <?= $_SESSION['admin_success'] ?>
            </div>
            <?php unset($_SESSION['admin_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['admin_error'])): ?>
            <div class="message">
                <?= $_SESSION['admin_error'] ?>
            </div>
            <?php unset($_SESSION['admin_error']); ?>
        <?php endif; ?>

        <div class="admin-actions">
            <a href="/admin-add-car" class="button-primary">Nieuwe Auto Toevoegen</a>
        </div>

        <div class="admin-content">
            <div class="cars-table-container">
                <h2>Huidige Wagenpark</h2>
                
                <?php if (isset($error)): ?>
                    <div class="message"><?= $error ?></div>
                <?php elseif (count($cars) > 0): ?>
                    <div class="cars-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Afbeelding</th>
                                    <th>Merk & Type</th>
                                    <th>Categorie</th>
                                    <th>Prijs</th>
                                    <th>Status</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cars as $car): ?>
                                <tr>
                                    <td class="car-image-cell">
                                        <img src="assets/images/products/<?= htmlspecialchars($car['main_image']) ?>" 
                                             alt="<?= htmlspecialchars($car['brand']) ?>"
                                             class="car-thumbnail">
                                    </td>
                                    <td>
                                        <div class="car-info">
                                            <strong><?= htmlspecialchars($car['brand']) ?></strong>
                                            <span class="car-type"><?= htmlspecialchars($car['type']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="car-category"><?= htmlspecialchars($car['type']) ?></span>
                                    </td>
                                    <td>
                                        <div class="car-price">
                                            <span class="current-price">€<?= number_format($car['price'], 2, ',', '.') ?></span>
                                            <?php if ($car['old_price'] > $car['price']): ?>
                                                <span class="old-price">€<?= number_format($car['old_price'], 2, ',', '.') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">Actief</span>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="action-buttons">
                                            <a href="/admin-edit-car?id=<?= $car['id'] ?>" 
                                               class="button-secondary small">Bewerken</a>
                                            <button onclick="deleteCar(<?= $car['id'] ?>, '<?= htmlspecialchars($car['brand']) ?>')" 
                                                    class="button-danger small">Verwijderen</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="no-cars">
                        <h3>Geen auto's gevonden</h3>
                        <p>Voeg uw eerste auto toe aan het wagenpark.</p>
                        <a href="/admin-add-car" class="button-primary">Eerste Auto Toevoegen</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
function deleteCar(carId, carName) {
    if (confirm(`Weet u zeker dat u de auto "${carName}" wilt verwijderen?`)) {
        window.location.href = `/admin-delete-car?id=${carId}`;
    }
}
</script>

<style>
.admin-main {
    min-height: 100vh;
    background: #f8f9fb;
    padding: 20px 0;
}

.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.admin-header {
    text-align: center;
    margin-bottom: 40px;
}

.admin-header h1 {
    font-size: 2.5rem;
    color: #3563E9;
    margin-bottom: 10px;
    font-weight: 800;
}

.admin-header p {
    color: #666;
    font-size: 1.1rem;
}

.admin-actions {
    margin-bottom: 30px;
    text-align: right;
}

.cars-table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    overflow: hidden;
}

.cars-table-container h2 {
    padding: 24px 24px 0 24px;
    margin: 0;
    color: #333;
    font-size: 1.4rem;
    font-weight: 700;
}

.cars-table {
    overflow-x: auto;
}

.cars-table table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
}

.cars-table th {
    background: #f8f9fb;
    padding: 16px 12px;
    text-align: left;
    font-weight: 600;
    color: #555;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.cars-table td {
    padding: 16px 12px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.cars-table tr:hover {
    background: #f8f9fb;
}

.car-image-cell {
    width: 80px;
}

.car-thumbnail {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.car-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.car-info strong {
    color: #333;
    font-size: 1rem;
}

.car-type {
    color: #666;
    font-size: 0.9rem;
}

.car-category {
    background: #e3f2fd;
    color: #1976d2;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.car-price {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.current-price {
    font-weight: 700;
    color: #3563E9;
    font-size: 1rem;
}

.old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 0.85rem;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.status-active {
    background: #e8f5e8;
    color: #2e7d32;
}

.actions-cell {
    width: 160px;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.button-secondary.small {
    padding: 6px 12px;
    font-size: 0.85rem;
}

.button-danger {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 600;
    transition: background 0.2s;
}

.button-danger:hover {
    background: #c82333;
}

.button-danger.small {
    padding: 6px 12px;
    font-size: 0.85rem;
}

.no-cars {
    text-align: center;
    padding: 60px 24px;
    color: #666;
}

.no-cars h3 {
    margin-bottom: 10px;
    color: #333;
}

.no-cars p {
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .admin-container {
        padding: 0 10px;
    }
    
    .admin-header h1 {
        font-size: 2rem;
    }
    
    .cars-table {
        font-size: 0.9rem;
    }
    
    .cars-table th,
    .cars-table td {
        padding: 12px 8px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .actions-cell {
        width: 120px;
    }
}
</style>

<?php require __DIR__ . "/../includes/footer.php" ?> 