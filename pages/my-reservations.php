<?php
session_start();
require "includes/header.php";

// Redirect to home if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit();
}

// Get user's reservations
require_once __DIR__ . "/../database/connection.php";

try {
    $stmt = $conn->prepare("
        SELECT r.*, c.brand, c.type, c.main_image, c.price as car_price
        FROM reservations r
        JOIN cars c ON r.car_id = c.id
        WHERE r.user_id = :user_id
        ORDER BY r.created_at DESC
    ");
    $stmt->bindParam(":user_id", $_SESSION['id']);
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Er is een fout opgetreden bij het ophalen van uw reserveringen: " . $e->getMessage();
}
?>

<main class="reservations-main">
    <div class="reservations-container">
        <!-- Header Section -->
        <div class="reservations-header">
            <div class="header-content">
                <h1>Mijn Reserveringen</h1>
                <p>Beheer en bekijk al uw autoreserveringen bij Rydr</p>
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-number"><?= count($reservations) ?></span>
                    <span class="stat-label">Totaal</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?= count(array_filter($reservations, function($r) { return $r['status'] === 'pending'; })) ?></span>
                    <span class="stat-label">In afwachting</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?= count(array_filter($reservations, function($r) { return $r['status'] === 'confirmed'; })) ?></span>
                    <span class="stat-label">Bevestigd</span>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['reservation_success'])): ?>
            <div class="success-message">
                <i class="fa fa-check-circle"></i>
                <span><?= $_SESSION['reservation_success'] ?></span>
            </div>
            <?php unset($_SESSION['reservation_success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['reservation_error'])): ?>
            <div class="error-message">
                <i class="fa fa-exclamation-circle"></i>
                <span><?= $_SESSION['reservation_error'] ?></span>
            </div>
            <?php unset($_SESSION['reservation_error']); ?>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="error-message">
                <i class="fa fa-exclamation-circle"></i>
                <span><?= $error ?></span>
            </div>
        <?php else: ?>
            <?php if (count($reservations) > 0): ?>
                <!-- Reservations List -->
                <div class="reservations-grid">
                    <?php foreach ($reservations as $reservation): ?>
                        <div class="reservation-card">
                            <!-- Car Image Section -->
                            <div class="reservation-image">
                                <img src="assets/images/products/<?= htmlspecialchars($reservation['main_image']) ?>" 
                                     alt="<?= htmlspecialchars($reservation['brand']) ?> <?= htmlspecialchars($reservation['type']) ?>">
                                <div class="reservation-status <?= $reservation['status'] ?>">
                                    <?php
                                    switch ($reservation['status']) {
                                        case 'pending':
                                            echo '<i class="fa fa-clock"></i> In afwachting';
                                            break;
                                        case 'confirmed':
                                            echo '<i class="fa fa-check"></i> Bevestigd';
                                            break;
                                        case 'canceled':
                                            echo '<i class="fa fa-times"></i> Geannuleerd';
                                            break;
                                        case 'completed':
                                            echo '<i class="fa fa-flag-checkered"></i> Voltooid';
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Reservation Details -->
                            <div class="reservation-details">
                                <div class="car-info">
                                    <h3><?= htmlspecialchars($reservation['brand']) ?> <?= htmlspecialchars($reservation['type']) ?></h3>
                                    <span class="car-type"><?= htmlspecialchars($reservation['type']) ?></span>
                                </div>

                                <div class="reservation-dates">
                                    <div class="date-item">
                                        <div class="date-icon">
                                            <i class="fa fa-calendar-plus"></i>
                                        </div>
                                        <div class="date-info">
                                            <span class="date-label">Ophaaldatum</span>
                                            <span class="date-value"><?= date('d M Y', strtotime($reservation['start_date'])) ?></span>
                                        </div>
                                    </div>
                                    <div class="date-item">
                                        <div class="date-icon">
                                            <i class="fa fa-calendar-minus"></i>
                                        </div>
                                        <div class="date-info">
                                            <span class="date-label">Retourdatum</span>
                                            <span class="date-value"><?= date('d M Y', strtotime($reservation['end_date'])) ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reservation-summary">
                                    <div class="summary-item">
                                        <span class="summary-label">Aantal dagen</span>
                                        <span class="summary-value"><?= ceil((strtotime($reservation['end_date']) - strtotime($reservation['start_date'])) / (60 * 60 * 24)) ?> dagen</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Prijs per dag</span>
                                        <span class="summary-value">€<?= number_format($reservation['car_price'], 2, ',', '.') ?></span>
                                    </div>
                                    <div class="summary-item total">
                                        <span class="summary-label">Totaalbedrag</span>
                                        <span class="summary-value">€<?= number_format($reservation['total_price'], 2, ',', '.') ?></span>
                                    </div>
                                </div>

                                <div class="reservation-actions">
                                    <?php if ($reservation['status'] === 'pending'): ?>
                                        <button class="btn-secondary" onclick="cancelReservation(<?= $reservation['id'] ?>)">
                                            <i class="fa fa-times"></i> Annuleren
                                        </button>
                                    <?php endif; ?>
                                    
                                    <?php if ($reservation['status'] === 'confirmed'): ?>
                                        <button class="btn-primary">
                                            <i class="fa fa-download"></i> Download Contract
                                        </button>
                                    <?php endif; ?>
                                    
                                    <button class="btn-outline" onclick="viewDetails(<?= $reservation['id'] ?>)">
                                        <i class="fa fa-eye"></i> Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fa fa-calendar-times"></i>
                    </div>
                    <h2>Geen reserveringen gevonden</h2>
                    <p>U heeft nog geen autoreserveringen. Bekijk ons aanbod en maak uw eerste reservering.</p>
                    <a href="/ons-aanbod" class="btn-primary">
                        <i class="fa fa-car"></i> Bekijk ons aanbod
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<script>
function cancelReservation(reservationId) {
    if (confirm('Weet u zeker dat u deze reservering wilt annuleren?')) {
        // Hier zou je een AJAX call kunnen maken om de reservering te annuleren
        alert('Annuleren functionaliteit wordt binnenkort toegevoegd.');
    }
}

function viewDetails(reservationId) {
    // Hier zou je naar een detail pagina kunnen navigeren
    alert('Detail pagina wordt binnenkort toegevoegd.');
}
</script>

<style>
.reservations-main {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fb 0%, #e9ecef 100%);
    padding: 40px 0;
}

.reservations-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header Section */
.reservations-header {
    background: white;
    border-radius: 16px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.header-content h1 {
    font-size: 2.5rem;
    color: #3563E9;
    margin: 0 0 10px 0;
    font-weight: 800;
    letter-spacing: -1px;
}

.header-content p {
    color: #666;
    font-size: 1.1rem;
    margin: 0;
}

.header-stats {
    display: flex;
    gap: 30px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fb;
    border-radius: 12px;
    min-width: 100px;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    color: #3563E9;
    line-height: 1;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    color: #666;
    margin-top: 5px;
    font-weight: 600;
}

/* Messages */
.success-message, .error-message {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
}

.success-message {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error-message {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.success-message i, .error-message i {
    font-size: 1.2rem;
}

/* Reservations Grid */
.reservations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
}

.reservation-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.reservation-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

/* Image Section */
.reservation-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.reservation-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.reservation-status {
    position: absolute;
    top: 16px;
    right: 16px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.reservation-status.pending {
    background: #fff3cd;
    color: #856404;
}

.reservation-status.confirmed {
    background: #d4edda;
    color: #155724;
}

.reservation-status.canceled {
    background: #f8d7da;
    color: #721c24;
}

.reservation-status.completed {
    background: #d1ecf1;
    color: #0c5460;
}

/* Details Section */
.reservation-details {
    padding: 24px;
}

.car-info {
    margin-bottom: 20px;
}

.car-info h3 {
    font-size: 1.4rem;
    color: #333;
    margin: 0 0 8px 0;
    font-weight: 700;
}

.car-type {
    background: #e3f2fd;
    color: #1976d2;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Dates Section */
.reservation-dates {
    margin-bottom: 20px;
}

.date-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.date-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3563E9;
    font-size: 1rem;
}

.date-info {
    flex: 1;
}

.date-label {
    display: block;
    font-size: 0.85rem;
    color: #666;
    font-weight: 600;
}

.date-value {
    display: block;
    font-size: 1rem;
    color: #333;
    font-weight: 700;
}

/* Summary Section */
.reservation-summary {
    background: #f8f9fb;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.summary-item:last-child {
    margin-bottom: 0;
    padding-top: 8px;
    border-top: 1px solid #e9ecef;
}

.summary-item.total {
    font-weight: 700;
    font-size: 1.1rem;
    color: #3563E9;
}

.summary-label {
    color: #666;
    font-size: 0.9rem;
}

.summary-value {
    color: #333;
    font-weight: 600;
}

/* Actions Section */
.reservation-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary, .btn-outline {
    padding: 10px 16px;
    border-radius: 8px;
    border: none;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-primary {
    background: #3563E9;
    color: white;
}

.btn-primary:hover {
    background: #2d5bd8;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #dc3545;
    color: white;
}

.btn-secondary:hover {
    background: #c82333;
    transform: translateY(-1px);
}

.btn-outline {
    background: transparent;
    color: #3563E9;
    border: 2px solid #3563E9;
}

.btn-outline:hover {
    background: #3563E9;
    color: white;
    transform: translateY(-1px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.empty-icon {
    font-size: 4rem;
    color: #ccc;
    margin-bottom: 20px;
}

.empty-state h2 {
    font-size: 1.8rem;
    color: #333;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.empty-state p {
    color: #666;
    font-size: 1.1rem;
    margin: 0 0 30px 0;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .reservations-container {
        padding: 0 10px;
    }
    
    .reservations-header {
        flex-direction: column;
        text-align: center;
        padding: 30px 20px;
    }
    
    .header-content h1 {
        font-size: 2rem;
    }
    
    .header-stats {
        gap: 15px;
    }
    
    .stat-item {
        min-width: 80px;
        padding: 15px;
    }
    
    .reservations-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .reservation-details {
        padding: 20px;
    }
    
    .reservation-actions {
        flex-direction: column;
    }
    
    .btn-primary, .btn-secondary, .btn-outline {
        width: 100%;
        justify-content: center;
    }
}
</style>

<?php require "includes/footer.php" ?>
