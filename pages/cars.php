<?php
require_once '../config/database.php';

// Get all cars from the database
$query = "SELECT * FROM cars WHERE is_available = 1 ORDER BY type, category";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Car Selection - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .car-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        .car-card:hover {
            transform: translateY(-5px);
        }
        .car-image {
            height: 200px;
            object-fit: contain;
            background-color: #f8f9fa;
        }
        .price-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .car-features {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.9rem;
        }
        .car-feature {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .section-title {
            margin: 40px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <h1 class="text-center mb-5">Our Car Selection</h1>

        <!-- Regular Cars Section -->
        <h2 class="section-title">Regular Cars</h2>
        <div class="row">
            <?php
            mysqli_data_seek($result, 0);
            while ($car = mysqli_fetch_assoc($result)) {
                if ($car['type'] === 'regular') {
            ?>
                <div class="col-md-4">
                    <div class="card car-card">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top car-image" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                            <span class="price-tag">€<?php echo number_format($car['price'], 2); ?>/day</span>
                            <span class="badge bg-primary category-badge"><?php echo htmlspecialchars($car['category']); ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($car['description']); ?></p>
                            <div class="car-features">
                                <span class="car-feature">
                                    <i class="fas fa-users"></i> <?php echo htmlspecialchars($car['capacity']); ?>
                                </span>
                                <span class="car-feature">
                                    <i class="fas fa-cog"></i> <?php echo htmlspecialchars($car['transmission']); ?>
                                </span>
                                <span class="car-feature">
                                    <i class="fas fa-gas-pump"></i> <?php echo htmlspecialchars($car['fuel_capacity']); ?>
                                </span>
                            </div>
                            <a href="reservation.php?car_id=<?php echo $car['id']; ?>" class="btn btn-primary w-100 mt-3">Rent Now</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- Business Cars Section -->
        <h2 class="section-title">Business Cars</h2>
        <div class="row">
            <?php
            mysqli_data_seek($result, 0);
            while ($car = mysqli_fetch_assoc($result)) {
                if ($car['type'] === 'business') {
            ?>
                <div class="col-md-4">
                    <div class="card car-card">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top car-image" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                            <span class="price-tag">€<?php echo number_format($car['price'], 2); ?>/day</span>
                            <span class="badge bg-success category-badge"><?php echo htmlspecialchars($car['category']); ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($car['description']); ?></p>
                            <div class="car-features">
                                <span class="car-feature">
                                    <i class="fas fa-users"></i> <?php echo htmlspecialchars($car['capacity']); ?>
                                </span>
                                <span class="car-feature">
                                    <i class="fas fa-cog"></i> <?php echo htmlspecialchars($car['transmission']); ?>
                                </span>
                                <span class="car-feature">
                                    <i class="fas fa-gas-pump"></i> <?php echo htmlspecialchars($car['fuel_capacity']); ?>
                                </span>
                            </div>
                            <a href="reservation.php?car_id=<?php echo $car['id']; ?>" class="btn btn-success w-100 mt-3">Rent Now</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 