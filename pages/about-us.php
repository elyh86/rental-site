<?php
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons - Auto Verhuur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/about-us.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5">Over Ons</h1>
            </div>
        </div>

        <!-- Ons Verhaal -->
        <div class="about-section">
            <h2>Ons Verhaal</h2>
            <p>Bij Auto Verhuur zijn we al meer dan 10 jaar actief in de autoverhuur branche. Wat begon als een kleine familiezaak is uitgegroeid tot een toonaangevende verhuurder van kwaliteitsauto's in Nederland.</p>
            <p>Onze missie is om onze klanten de beste service en de hoogste kwaliteit auto's te bieden tegen een eerlijke prijs. We geloven dat een goede service begint bij een persoonlijke aanpak en aandacht voor detail.</p>
        </div>

        <!-- Onze Kernwaarden -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center mb-4">Onze Kernwaarden</h2>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <i class="fas fa-star"></i>
                    <h3>Kwaliteit</h3>
                    <p>We bieden alleen auto's van de hoogste kwaliteit aan, die regelmatig worden onderhouden en gecontroleerd.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <i class="fas fa-handshake"></i>
                    <h3>Betrouwbaarheid</h3>
                    <p>Onze klanten kunnen rekenen op een betrouwbare service en eerlijke prijzen zonder verborgen kosten.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <i class="fas fa-heart"></i>
                    <h3>Klantgerichtheid</h3>
                    <p>We zetten onze klanten altijd op de eerste plaats en doen er alles aan om aan hun verwachtingen te voldoen.</p>
                </div>
            </div>
        </div>

        <!-- Ons Team -->
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Ons Team</h2>
            </div>
            <div class="col-md-4">
                <div class="team-card">
                    <img src="/assets/images/team/john.jpg" alt="John Doe" class="rounded-circle">
                    <h3>John Doe</h3>
                    <p class="position">Eigenaar</p>
                    <p>Met meer dan 15 jaar ervaring in de autobranche leidt John ons bedrijf met passie en expertise.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-card">
                    <img src="/assets/images/team/jane.jpg" alt="Jane Smith" class="rounded-circle">
                    <h3>Jane Smith</h3>
                    <p class="position">Manager</p>
                    <p>Jane zorgt ervoor dat alles soepel verloopt en dat onze klanten de beste service krijgen.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-card">
                    <img src="/assets/images/team/mike.jpg" alt="Mike Johnson" class="rounded-circle">
                    <h3>Mike Johnson</h3>
                    <p class="position">Service Manager</p>
                    <p>Mike en zijn team zorgen ervoor dat al onze auto's in perfecte staat verkeren.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
