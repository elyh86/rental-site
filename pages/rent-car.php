<?php
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Huren - Rydr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/rent-car.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center mb-5">Auto Huren</h1>
                
                <div class="rent-car-form">
                    <form id="rentCarForm" class="needs-validation" novalidate>
                        <!-- Persoonlijke Gegevens -->
                        <div class="form-section">
                            <h2><i class="bi bi-person-circle"></i> Persoonlijke Gegevens</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Voornaam</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Achternaam</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mailadres</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telefoonnummer</label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="birthDate" class="form-label">Geboortedatum</label>
                                    <input type="date" class="form-control" id="birthDate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="licenseNumber" class="form-label">Rijbewijsnummer</label>
                                    <input type="text" class="form-control" id="licenseNumber" required>
                                </div>
                            </div>
                        </div>

                        <!-- Adresgegevens -->
                        <div class="form-section">
                            <h2><i class="bi bi-geo-alt"></i> Adresgegevens</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="street" class="form-label">Straat</label>
                                    <input type="text" class="form-control" id="street" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="houseNumber" class="form-label">Huisnummer</label>
                                    <input type="text" class="form-control" id="houseNumber" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="addition" class="form-label">Toevoeging</label>
                                    <input type="text" class="form-control" id="addition">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="postalCode" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" id="postalCode" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="city" class="form-label">Plaats</label>
                                    <input type="text" class="form-control" id="city" required>
                                </div>
                            </div>
                        </div>

                        <!-- Reserveringsgegevens -->
                        <div class="form-section">
                            <h2><i class="bi bi-calendar-check"></i> Reserveringsgegevens</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickupDate" class="form-label">Ophaaldatum</label>
                                    <input type="datetime-local" class="form-control" id="pickupDate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="returnDate" class="form-label">Retourdatum</label>
                                    <input type="datetime-local" class="form-control" id="returnDate" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickupLocation" class="form-label">Ophaallocatie</label>
                                    <select class="form-select" id="pickupLocation" required>
                                        <option value="">Selecteer locatie</option>
                                        <option value="amsterdam">Amsterdam Centraal</option>
                                        <option value="rotterdam">Rotterdam Centraal</option>
                                        <option value="denhaag">Den Haag Centraal</option>
                                        <option value="utrecht">Utrecht Centraal</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="returnLocation" class="form-label">Retourlocatie</label>
                                    <select class="form-select" id="returnLocation" required>
                                        <option value="">Selecteer locatie</option>
                                        <option value="amsterdam">Amsterdam Centraal</option>
                                        <option value="rotterdam">Rotterdam Centraal</option>
                                        <option value="denhaag">Den Haag Centraal</option>
                                        <option value="utrecht">Utrecht Centraal</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Betalingsgegevens -->
                        <div class="form-section">
                            <h2><i class="bi bi-credit-card"></i> Betalingsgegevens</h2>
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label class="form-label">Betaalmethode</label>
                                    <div class="payment-methods">
                                        <div class="payment-method">
                                            <input type="radio" name="payment_method" id="creditCard" value="credit_card" required>
                                            <label for="creditCard">
                                                <i class="bi bi-credit-card"></i>
                                                Credit Card
                                            </label>
                                        </div>
                                        <div class="payment-method">
                                            <input type="radio" name="payment_method" id="ideal" value="ideal" required>
                                            <label for="ideal">
                                                <i class="bi bi-bank"></i>
                                                iDEAL
                                            </label>
                                        </div>
                                        <div class="payment-method">
                                            <input type="radio" name="payment_method" id="paypal" value="paypal" required>
                                            <label for="paypal">
                                                <i class="bi bi-paypal"></i>
                                                PayPal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Credit Card velden (initieel verborgen) -->
                            <div id="creditCardFields" class="payment-fields" style="display: none;">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="cardNumber" class="form-label">Kaartnummer</label>
                                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expiryDate" class="form-label">Vervaldatum</label>
                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <!-- iDEAL velden (initieel verborgen) -->
                            <div id="idealFields" class="payment-fields" style="display: none;">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="bankSelect" class="form-label">Kies uw bank</label>
                                        <select class="form-select" id="bankSelect">
                                            <option value="">Selecteer uw bank</option>
                                            <option value="INGBNL2A">ING Bank</option>
                                            <option value="RABONL2U">Rabobank</option>
                                            <option value="ABNANL2A">ABN AMRO</option>
                                            <option value="SNSBNL2A">SNS Bank</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- PayPal velden (initieel verborgen) -->
                            <div id="paypalFields" class="payment-fields" style="display: none;">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <p class="text-muted">U wordt doorgestuurd naar PayPal om uw betaling te voltooien.</p>
                                    </div>
                </div>
            </div>
                        </div>

                        <!-- Extra's -->
                        <div class="form-section">
                            <h2><i class="bi bi-plus-circle"></i> Extra's</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="extraInsurance">
                                        <label class="form-check-label" for="extraInsurance">
                                            Extra verzekering (+€15/dag)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="childSeat">
                                        <label class="form-check-label" for="childSeat">
                                            Kinderzitje (+€5/dag)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gps">
                                        <label class="form-check-label" for="gps">
                                            GPS navigatie (+€10/dag)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="winterTires">
                                        <label class="form-check-label" for="winterTires">
                                            Winterbanden (+€20/dag)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Samenvatting en Bevestiging -->
                        <div class="form-section">
                            <h2><i class="bi bi-check-circle"></i> Bevestiging</h2>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            Ik ga akkoord met de algemene voorwaarden en privacybeleid
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            Ik wil graag op de hoogte blijven van aanbiedingen en nieuws
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check2-circle"></i> Reservering Bevestigen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toon/verberg betaalvelden op basis van geselecteerde betaalmethode
        document.querySelectorAll('input[name="payment_method"]').forEach(input => {
            input.addEventListener('change', function() {
                // Verberg alle betaalvelden
                document.querySelectorAll('.payment-fields').forEach(field => {
                    field.style.display = 'none';
                });
                
                // Toon de geselecteerde betaalvelden
                const selectedMethod = this.value;
                document.getElementById(selectedMethod + 'Fields').style.display = 'block';
            });
        });
    </script>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/rent-car.js"></script>
</body>
</html> 