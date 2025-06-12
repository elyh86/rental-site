<?php
require_once "includes/header.php";
require_once "database/connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: /login-form');
    exit;
}

if (!isset($_GET['id'])) {
    echo '<main class="account-page"><div class="container"><h1>Auto huren</h1><p>Geen auto geselecteerd.</p></div></main>';
    require "includes/footer.php";
    exit;
}

$car_id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->execute([':id' => $car_id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$car) {
    echo '<main class="account-page"><div class="container"><h1>Auto huren</h1><p>Auto niet gevonden.</p></div></main>';
    require "includes/footer.php";
    exit;
}

// Verwerking van het formulier
$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $extras = isset($_POST['extras']) ? $_POST['extras'] : [];
    if (!$start_date || !$end_date) {
        $error = 'Vul beide datums in.';
    } elseif ($end_date < $start_date) {
        $error = 'Einddatum moet na begindatum liggen.';
    } else {
        // Check of de auto al verhuurd is in deze periode
        $stmt = $conn->prepare("SELECT COUNT(*) FROM rentals WHERE car_id = :car_id AND NOT (end_date < :start OR start_date > :end)");
        $stmt->execute([
            ':car_id' => $car_id,
            ':start' => $start_date,
            ':end' => $end_date
        ]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Deze auto is al verhuurd in de gekozen periode.';
        } else {
            // Opslaan in database
            $stmt = $conn->prepare("INSERT INTO rentals (user_id, car_id, start_date, end_date) VALUES (:user_id, :car_id, :start_date, :end_date)");
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'],
                ':car_id' => $car_id,
                ':start_date' => $start_date,
                ':end_date' => $end_date
            ]);
            $success = true;
        }
    }
}
?>
<main class="huur-auto-page">
    <div class="huur-container">
        <h1 class="huur-title">Auto huren</h1>
        <div class="huur-card">
            <div class="huur-car-info">
                <h2><?= htmlspecialchars($car['brand'].' '.$car['model']) ?></h2>
                <?php if (!empty($car['image_url'])): ?>
                    <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand'].' '.$car['model']) ?>">
                <?php endif; ?>
                <div class="huur-car-details">
                    <span class="huur-label">Categorie:</span> <?= htmlspecialchars($car['category']) ?> <br>
                    <span class="huur-label">Transmissie:</span> <?= htmlspecialchars($car['transmission']) ?> <br>
                    <span class="huur-label">Capaciteit:</span> <?= htmlspecialchars($car['capacity']) ?> <br>
                    <span class="huur-label">Prijs:</span> <b>€<?= number_format($car['price'], 2, ',', '.') ?>/dag</b>
                </div>
            </div>
            <div class="huur-form-section">
                <?php if ($success): ?>
                    <div class="succes-message">Je hebt deze auto succesvol gehuurd!</div>
                    <a href="/mijn-huurautos" class="button-primary">Bekijk mijn gehuurde auto's</a>
                <?php else: ?>
                    <?php if ($error): ?><div class="message"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                    <form method="post" class="huur-form">
                        <div class="form-group">
                            <label for="start_date">Begindatum</label>
                            <input type="date" id="start_date" name="start_date" required min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Einddatum</label>
                            <input type="date" id="end_date" name="end_date" required min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group huur-extras">
                            <label>Extra opties</label>
                            <div class="huur-extras-list">
                                <label><input type="checkbox" name="extras[]" value="navigatie"> Navigatie (€5/dag)</label>
                                <label><input type="checkbox" name="extras[]" value="kinderzitje"> Kinderzitje (€3/dag)</label>
                                <label><input type="checkbox" name="extras[]" value="extra_bestuurder"> Extra bestuurder (€7/dag)</label>
                            </div>
                        </div>
                        <button type="submit" class="button-primary huur-bevestig">Bevestig huur</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php require "includes/footer.php"; ?> 