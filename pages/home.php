<?php require "includes/header.php" ?>
    <header>
        <div class="advertorials">
            <div class="advertorial">
                <h2>Hét platform om een auto te huren</h2>
                <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
                <a href="<?php echo isset($_SESSION['id']) ? '/ons-aanbod?type=regular' : '/register-form'; ?>" class="button-primary">Huur nu een auto</a>
                <img src="assets/images/car-rent-header-image-1.png" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
            <div class="advertorial">
                <h2>Wij verhuren ook bedrijfsauto's</h2>
                <p>Voor een vaste lage prijs met prettig voordelen.</p>
                <a href="<?php echo isset($_SESSION['id']) ? '/ons-aanbod?type=bedrijfswagen' : '/register-form'; ?>" class="button-primary">Huur een bedrijfsauto</a>
                <img src="assets/images/products/pngtree-photo-white-van-png-image_11538407.png" alt="Bedrijfsauto" style="transform: scale(1.2); width: 85%; max-width: 280px; height: auto; margin-top: 10px; margin-bottom: 10px;">
                <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">
            </div>
        </div>
    </header>

    <main>
        <div class="section-header">
            <h2 class="section-title">Populaire Auto's</h2>
            <a href="/ons-aanbod" class="view-all">Bekijk Alles</a>
        </div>
        <div class="car-grid">
            <?php 
            // Include database connection
            require_once __DIR__ . "/../database/connection.php";
            
            try {
                // Get database connection
                $conn = $GLOBALS['conn'];
                // Fetch popular cars from database (limit to 4 for the homepage)
                $stmt = $conn->query("SELECT * FROM cars LIMIT 4");
                $popularCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error in home.php: " . $e->getMessage());
                echo "<div class='message'>Er is een fout opgetreden bij het ophalen van de gegevens. Probeer het later opnieuw.</div>";
                $popularCars = [];
            }
            
            // Display cars
            foreach ($popularCars as $car) :
            ?>
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

        <div class="section-header">
            <h2 class="section-title">Overige auto's</h2>
        </div>
        <div class="car-grid">
            <?php
            try {
                // Haal de overige auto's op (vanaf de 5e)
                $stmt = $conn->query("SELECT * FROM cars LIMIT 100 OFFSET 4");
                $otherCars = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error in home.php (overige auto's): " . $e->getMessage());
                echo "<div class='message'>Er is een fout opgetreden bij het ophalen van de overige auto's. Probeer het later opnieuw.</div>";
                $otherCars = [];
            }
            foreach ($otherCars as $car) :
            ?>
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

        <div class="show-more-cars">
            <a class="button-primary" href="/ons-aanbod">Meer auto's bekijken</a>
        </div>
    </main>

<?php require "includes/footer.php" ?>