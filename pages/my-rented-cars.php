<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';

// Controleer of gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: /login-form");
    exit;
}

try {
    // Haal alle verhuringen van de gebruiker op
    $stmt = $conn->prepare("
        SELECT r.*, c.brand, c.model, c.image_url 
        FROM rentals r 
        JOIN cars c ON r.car_id = c.id 
        WHERE r.user_id = ? 
        ORDER BY r.created_at DESC
    ");
    
    if (!$stmt) {
        throw new Exception("Database query voorbereiden mislukt: " . $conn->error);
    }
    
    $stmt->bind_param("i", $_SESSION['user_id']);
    
    if (!$stmt->execute()) {
        throw new Exception("Query uitvoeren mislukt: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $rentals = $result->fetch_all(MYSQLI_ASSOC);
    
} catch (Exception $e) {
    $error = "Er is een fout opgetreden bij het ophalen van uw verhuringen: " . $e->getMessage();
    $rentals = [];
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Verhuurde Auto's - Rydr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/my-rented-cars.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5">Mijn Verhuurde Auto's</h1>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Uw reservering is succesvol geplaatst!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (empty($rentals)): ?>
                    <div class="text-center">
                        <div class="empty-state">
                            <i class="bi bi-car-front"></i>
                            <h2>Geen verhuurde auto's</h2>
                            <p>U heeft nog geen auto's gehuurd.</p>
                            <a href="/our-offer" class="btn btn-primary">Auto huren</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="rentals-grid">
                        <?php foreach ($rentals as $rental): ?>
                            <div class="rental-card">
                                <div class="car-image">
                                    <img src="<?= htmlspecialchars($rental['image_url']) ?>" alt="<?= htmlspecialchars($rental['brand'] . ' ' . $rental['model']) ?>">
                                </div>
                                <div class="rental-details">
                                    <h3><?= htmlspecialchars($rental['brand'] . ' ' . $rental['model']) ?></h3>
                                    
                                    <div class="rental-info">
                                        <div class="info-item">
                                            <i class="bi bi-calendar-check"></i>
                                            <div>
                                                <strong>Ophaaldatum:</strong>
                                                <p><?= date('d-m-Y H:i', strtotime($rental['pickup_date'])) ?></p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-calendar-x"></i>
                                            <div>
                                                <strong>Retourdatum:</strong>
                                                <p><?= date('d-m-Y H:i', strtotime($rental['return_date'])) ?></p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <div>
                                                <strong>Locaties:</strong>
                                                <p>Ophalen: <?= htmlspecialchars($rental['pickup_location']) ?></p>
                                                <p>Retour: <?= htmlspecialchars($rental['return_location']) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="extras">
                                        <h4>Extra's:</h4>
                                        <ul>
                                            <?php if ($rental['extra_insurance']): ?>
                                                <li><i class="bi bi-check-circle"></i> Extra verzekering</li>
                                            <?php endif; ?>
                                            <?php if ($rental['child_seat']): ?>
                                                <li><i class="bi bi-check-circle"></i> Kinderzitje</li>
                                            <?php endif; ?>
                                            <?php if ($rental['gps']): ?>
                                                <li><i class="bi bi-check-circle"></i> GPS navigatie</li>
                                            <?php endif; ?>
                                            <?php if ($rental['winter_tires']): ?>
                                                <li><i class="bi bi-check-circle"></i> Winterbanden</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <div class="rental-status">
                                        <span class="badge bg-<?= $rental['status'] === 'confirmed' ? 'success' : ($rental['status'] === 'pending' ? 'warning' : 'secondary') ?>">
                                            <?= ucfirst($rental['status']) ?>
                                        </span>
                                    </div>

                                    <div class="rental-price">
                                        <h4>Totaalprijs:</h4>
                                        <p class="price">€<?= number_format($rental['total_price'], 2, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 