<?php 
require "includes/header.php";
require "database/connection.php";

// Haal alle auto's op uit de database
$stmt = $conn->prepare("SELECT * FROM cars WHERE type = 'regular' ORDER BY id ASC");
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Haal 1 transport auto op
$stmtTransport = $conn->prepare("SELECT * FROM cars WHERE category = 'Transport' LIMIT 1");
$stmtTransport->execute();
$transportCar = $stmtTransport->fetch(PDO::FETCH_ASSOC);
?>
    <header>
        <div class="advertorials">
            <div class="advertorial">
                <h2>Hét platform om een auto te huren</h2>
                <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
                <a href="/rent-car" class="button-primary">Huur nu een auto</a>
                <img src="assets/images/car-rent-header-image-1.png" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
            <div class="advertorial" style="position: relative; overflow: hidden;">
                <h2>Wij verhuren ook bedrijfswagens</h2>
                <p>Voor een vaste lage prijs met prettig voordelen.</p>
                <a href="/rent-car" class="button-primary">Huur een bedrijfswagen</a>
                <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">
                <img src="assets/images/waggiebedrijf.png" alt="Bedrijfswagen">
            </div>
        </div>
    </header>

    <main>
    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars">
        <?php 
        // Toon de eerste 4 auto's als populaire auto's
        for ($i = 0; $i < 4 && $i < count($cars); $i++) : 
            $car = $cars[$i];
        ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($car['brand']) ?></h3>
                    <div class="car-type">
                        <?= htmlspecialchars($car['category']) ?>
                    </div>
                </div>
                <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($car['fuel_capacity']) ?></span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?= htmlspecialchars($car['transmission']) ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($car['capacity']) ?></span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?= number_format($car['price'], 2, ',', '.') ?></span> / dag</span>
                    <a href="/rent-car" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <h2 class="section-title">Aanbevolen auto's</h2>
    <div class="cars">
        <?php 
        // Toon de overige auto's als aanbevolen auto's
        for ($i = 4; $i < count($cars); $i++) : 
            $car = $cars[$i];
        ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($car['brand']) ?></h3>
                    <div class="car-type">
                        <?= htmlspecialchars($car['category']) ?>
                    </div>
                </div>
                <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['brand']) ?>">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($car['fuel_capacity']) ?></span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?= htmlspecialchars($car['transmission']) ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($car['capacity']) ?></span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?= number_format($car['price'], 2, ',', '.') ?></span> / dag</span>
                    <a href="/rent-car" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="show-more">
        <a class="button-primary" href="/our-offer">Toon alle</a>
    </div>
    </main>

<?php require "includes/footer.php" ?>