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

// Get car ID from URL
$carId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($carId === 0) {
    header('Location: /admin');
    exit();
}

// Get car data from database
require_once __DIR__ . "/../database/connection.php";

try {
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
    $stmt->bindParam(':id', $carId);
    $stmt->execute();
    
    if ($stmt->rowCount() === 0) {
        $_SESSION['admin_error'] = "Auto niet gevonden.";
        header('Location: /admin');
        exit();
    }
    
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['admin_error'] = "Database error: " . $e->getMessage();
    header('Location: /admin');
    exit();
}

// Available car types
$carTypes = ['Sport', 'SUV', 'Sedan', 'Hatchback'];
$steeringOptions = ['Manual', 'Automatic', 'Electric'];
$capacityOptions = ['2 People', '4 People', '6 People', '8 People'];
?>

<main class="admin-main">
    <div class="admin-container">
        <div class="admin-header">
            <h1>Auto Bewerken</h1>
            <p>Bewerk de gegevens van <?= htmlspecialchars($car['brand']) ?></p>
        </div>

        <div class="admin-content">
            <div class="form-container">
                <form action="/admin-update-car" method="post" enctype="multipart/form-data" class="admin-form">
                    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                    
                    <div class="form-section">
                        <h3>Basis Informatie</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="brand">Merk *</label>
                                <input type="text" id="brand" name="brand" required 
                                       value="<?= htmlspecialchars($car['brand']) ?>"
                                       placeholder="bijv. BMW, Mercedes, Audi">
                            </div>
                            <div class="form-group">
                                <label for="type">Type *</label>
                                <select id="type" name="type" required>
                                    <option value="">Selecteer type</option>
                                    <?php foreach ($carTypes as $type): ?>
                                        <option value="<?= $type ?>" <?= $car['type'] === $type ? 'selected' : '' ?>>
                                            <?= $type ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Beschrijving *</label>
                            <textarea id="description" name="description" rows="4" required
                                      placeholder="Beschrijf de auto, zijn eigenschappen en voordelen..."><?= htmlspecialchars($car['description']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Specificaties</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="capacity">Capaciteit *</label>
                                <select id="capacity" name="capacity" required>
                                    <option value="">Selecteer capaciteit</option>
                                    <?php foreach ($capacityOptions as $capacity): ?>
                                        <option value="<?= $capacity ?>" <?= $car['capacity'] === $capacity ? 'selected' : '' ?>>
                                            <?= $capacity ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="steering">Besturing *</label>
                                <select id="steering" name="steering" required>
                                    <option value="">Selecteer besturing</option>
                                    <?php foreach ($steeringOptions as $steering): ?>
                                        <option value="<?= $steering ?>" <?= $car['steering'] === $steering ? 'selected' : '' ?>>
                                            <?= $steering ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gasoline">Brandstof *</label>
                            <input type="text" id="gasoline" name="gasoline" required 
                                   value="<?= htmlspecialchars($car['gasoline']) ?>"
                                   placeholder="bijv. 70L, Electric, Hybrid">
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Prijzen</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">Huurprijs per dag (€) *</label>
                                <input type="number" id="price" name="price" step="0.01" min="0" required 
                                       value="<?= $car['price'] ?>"
                                       placeholder="bijv. 75.00">
                            </div>
                            <div class="form-group">
                                <label for="old_price">Oude prijs (€) (optioneel)</label>
                                <input type="number" id="old_price" name="old_price" step="0.01" min="0" 
                                       value="<?= $car['old_price'] ?>"
                                       placeholder="bijv. 90.00">
                                <small>Laat leeg als er geen oude prijs is</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Afbeelding</h3>
                        
                        <div class="current-image">
                            <label>Huidige afbeelding:</label>
                            <div class="image-preview">
                                <img src="assets/images/products/<?= htmlspecialchars($car['main_image']) ?>" 
                                     alt="<?= htmlspecialchars($car['brand']) ?>">
                                <span class="image-name"><?= htmlspecialchars($car['main_image']) ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="main_image">Nieuwe afbeelding (optioneel)</label>
                            <input type="file" id="main_image" name="main_image" accept="image/*">
                            <small>Upload een nieuwe afbeelding om de huidige te vervangen (JPG, PNG, SVG)</small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="/admin" class="button-secondary">Annuleren</a>
                        <button type="submit" class="button-primary">Wijzigingen Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
.admin-main {
    min-height: 100vh;
    background: #f8f9fb;
    padding: 20px 0;
}

.admin-container {
    max-width: 800px;
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

.form-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    overflow: hidden;
}

.admin-form {
    padding: 32px;
}

.form-section {
    margin-bottom: 32px;
}

.form-section h3 {
    color: #333;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f3f4;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
    font-size: 0.95rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3563E9;
    box-shadow: 0 0 0 3px rgba(53, 99, 233, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.form-group input[type="file"] {
    padding: 8px;
    border: 2px dashed #e9ecef;
    background: #f8f9fb;
}

.form-group input[type="file"]:hover {
    border-color: #3563E9;
    background: #f0f4ff;
}

.form-group small {
    display: block;
    margin-top: 6px;
    color: #666;
    font-size: 0.85rem;
}

.current-image {
    margin-bottom: 20px;
}

.current-image label {
    display: block;
    margin-bottom: 12px;
    color: #333;
    font-weight: 600;
    font-size: 0.95rem;
}

.image-preview {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8f9fb;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.image-preview img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.image-name {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.form-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    padding-top: 24px;
    border-top: 1px solid #f1f3f4;
    margin-top: 32px;
}

@media (max-width: 768px) {
    .admin-container {
        padding: 0 10px;
    }
    
    .admin-header h1 {
        font-size: 2rem;
    }
    
    .admin-form {
        padding: 20px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .image-preview {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .button-primary,
    .form-actions .button-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>

<?php require __DIR__ . "/../includes/footer.php" ?> 