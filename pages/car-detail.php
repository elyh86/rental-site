<?php require "includes/header.php" ?>

<?php
//TODO: Implementeer dat de pagina de juiste auto laat zien op basis van de query paramater 'name'
//$name = $_GET['name'] ?? null;

//if ($name) {
//    echo "Toon details van auto met naam: " . htmlspecialchars($name);
//} else {
//    echo "Geen auto opgegeven.";
//}



?>
<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <h2>Sport auto met het beste design en snelheid</h2>
                <p>Veiligheid en comfort terwijl je rijd in een futiristische en elante auto </p>
                <img src="assets/images/car-rent-header-image-1.png" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
        </div>
        <div class="row white-background">
            <h2>Nissan GT-R</h2>
            <div class="rating">
                <span class="stars stars-4"></span>
                <span>440+ reviewers</span>
            </div>
            <p>NISMO is het toonbeeld geworden van Nissan's uitzonderlijke prestaties, geïnspireerd door het meest meedogenloze testterrein: het circuit.</p>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type Car</span><span>Sport</span></div>
                    <div class="row"><span class="accent-color">Capacity</span><span>2 person</span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">Steering</span><span>Manual</span></div>
                    <div class="row"><span class="accent-color">Gasoline</span><span>70L</span></div>
                </div>
                <div class="call-to-action">
                    <div class="row"><span class="font-weight-bold">€80,00</span> / dag</div>
                    <div class="row"><a href="" class="button-primary">Huur nu</a></div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php require "includes/footer.php" ?>
