<?php
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onze Visie - Rydr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/vision.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center mb-5">Onze Visie</h1>
                
                <div class="vision-grid">
                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">🚗</div>
                                <h3>Mobiliteit voor Iedereen</h3>
                                <p>Ontdek hoe we mobiliteit toegankelijk maken</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">
                                    Bij Rydr geloven we dat mobiliteit een fundamenteel recht is. Onze visie is om autohuur toegankelijk, 
                                    betaalbaar en duurzaam te maken voor iedereen. We streven ernaar om de manier waarop mensen denken 
                                    over autohuur te veranderen - van een complex proces naar een eenvoudige, transparante ervaring.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">🌱</div>
                                <h3>Duurzaamheid</h3>
                                <p>Onze toewijding aan een groene toekomst</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">
                                    We zijn vastbesloten om een positieve impact te maken op het milieu. Onze vloot wordt continu 
                                    vernieuwd met energiezuinige en elektrische voertuigen. We werken actief aan het verminderen van 
                                    onze ecologische voetafdruk en het promoten van duurzame mobiliteitsoplossingen.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">💡</div>
                                <h3>Innovatie</h3>
                                <p>Technologie die het verschil maakt</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">
                                    Technologie staat centraal in onze visie. We investeren voortdurend in innovatieve oplossingen 
                                    die het huren van een auto eenvoudiger en efficiënter maken. Van ons geavanceerde reserveringssysteem 
                                    tot onze gebruiksvriendelijke app - alles is ontworpen met de klant in gedachten.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">👥</div>
                                <h3>Klantgerichtheid</h3>
                                <p>Uw tevredenheid staat voorop</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">
                                    De tevredenheid van onze klanten staat voorop. We streven ernaar om een naadloze en plezierige 
                                    ervaring te bieden, van het moment van reservering tot het terugbrengen van de auto. Onze 
                                    klantenservice is 24/7 beschikbaar om ervoor te zorgen dat u altijd de hulp krijgt die u nodig heeft.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">🔮</div>
                                <h3>Toekomstgericht</h3>
                                <p>Voorbereid op morgen</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">
                                    We kijken vooruit naar de toekomst van mobiliteit. Met de opkomst van autonome voertuigen, 
                                    deeleconomie en nieuwe mobiliteitsconcepten, positioneren we Rydr als een innovatieve speler 
                                    die klaar is voor de uitdagingen en kansen van morgen.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-card">
                        <div class="vision-card-inner">
                            <div class="vision-card-front">
                                <div class="vision-icon">✨</div>
                                <h3>Onze Belofte</h3>
                                <p>Wat u van ons kunt verwachten</p>
                            </div>
                            <div class="vision-card-back">
                                <p class="lead">Bij Rydr beloven we u:</p>
                                <ul class="list-unstyled">
                                    <li class="mb-3">✓ Transparante prijzen zonder verborgen kosten</li>
                                    <li class="mb-3">✓ Een moderne en diverse vloot van voertuigen</li>
                                    <li class="mb-3">✓ Uitstekende klantenservice</li>
                                    <li class="mb-3">✓ Duurzame en milieuvriendelijke opties</li>
                                    <li class="mb-3">✓ Innovatieve en gebruiksvriendelijke technologie</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 