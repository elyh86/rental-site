<?php
session_start();
require "includes/header.php";

// Redirect to home if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit();
}

// Get user's reservations
require_once "database/connection.php";

try {
    $stmt = $conn->prepare("
        SELECT r.*, c.brand, c.type, c.main_image 
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

<main>
    <div class="my-reservations-container">
        <div class="my-reservations-header">
            <h1>Mijn Reserveringen</h1>
            <p>Bekijk en beheer uw autoreserveringen bij Rydr</p>
        </div>
        
        <?php if (isset($_SESSION['reservation_success'])): ?>
            <div class="succes-message">
                <?= $_SESSION['reservation_success'] ?>
            </div>
            <?php unset($_SESSION['reservation_success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['reservation_error'])): ?>
            <div class="message">
                <?= $_SESSION['reservation_error'] ?>
            </div>
            <?php unset($_SESSION['reservation_error']); ?>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="message"><?= $error ?></div>
        <?php else: ?>
            <?php if (count($reservations) > 0): ?>
                <div class="reservations-list">
                    <?php foreach ($reservations as $reservation): ?>
                        <div class="reservation-card">
                            <div class="reservation-car-image">
                                <?php
                                $status_class = '';
                                switch ($reservation['status']) {
                                    case 'pending':
                                        $status_text = 'In afwachting';
                                        $status_class = 'status-pending';
                                        break;
                                    case 'confirmed':
                                        $status_text = 'Bevestigd';
                                        $status_class = 'status-confirmed';
                                        break;
                                    case 'canceled':
                                        $status_text = 'Geannuleerd';
                                        $status_class = 'status-canceled';
                                        break;
                                    case 'completed':
                                        $status_text = 'Voltooid';
                                        $status_class = 'status-completed';
                                        break;
                                }
                                ?>
                                <div class="reservation-status <?= $status_class ?>"><?= $status_text ?></div>
                                <img src="assets/images/products/<?= $reservation['main_image'] ?>" alt="<?= $reservation['brand'] ?> <?= $reservation['type'] ?>">
                            </div>
                            <div class="reservation-details">
                                <div class="reservation-car-name"><?= $reservation['brand'] ?> <?= $reservation['type'] ?></div>
                                <div class="reservation-dates">
                                    <div class="reservation-date">
                                        <span class="reservation-date-label">Ophaaldatum</span>
                                        <span class="reservation-date-value"><?= date('d-m-Y', strtotime($reservation['start_date'])) ?></span>
                                    </div>
                                    <div class="reservation-date">
                                        <span class="reservation-date-label">Retourdatum</span>
                                        <span class="reservation-date-value"><?= date('d-m-Y', strtotime($reservation['end_date'])) ?></span>
                                    </div>
                                </div>
                                <div class="reservation-price">
                                    <span class="reservation-price-label">Totaal</span>
                                    <span class="reservation-price-value">€<?= number_format($reservation['total_price'], 2, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-reservations">
                    <h2>U heeft nog geen reserveringen</h2>
                    <p>Bekijk ons aanbod en maak uw eerste autoreservering.</p>
                    <a href="/ons-aanbod" class="button-primary">Bekijk ons aanbod</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php require "includes/footer.php" ?>
