<?php
require_once '../config/database.php';

// Get all available cars with their details
$query = "SELECT c.*, b.name as brand_name, 
          COALESCE((SELECT AVG(rating) FROM reviews WHERE car_id = c.id), 0) as avg_rating,
          (SELECT COUNT(*) FROM reviews WHERE car_id = c.id) as review_count
          FROM cars c 
          LEFT JOIN brands b ON c.brand_id = b.id 
          WHERE c.is_available = 1 
          ORDER BY c.id ASC";
$result = mysqli_query($conn, $query);
$cars = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cars[] = $row;
}
$featured_car = $cars[1] ?? ($cars[0] ?? null);

// Get unique categories and capacities for filters
$categories = [];
$capacities = [];
$category_counts = [];
$capacity_counts = [];

foreach ($cars as $car) {
    // Categories
    if (!empty($car['category'])) {
        if (!isset($category_counts[$car['category']])) {
            $category_counts[$car['category']] = 0;
            $categories[] = $car['category'];
        }
        $category_counts[$car['category']]++;
    }
    
    // Capacities
    if (!empty($car['capacity'])) {
        $capacity_label = $car['capacity'] . ' Person';
        if (!isset($capacity_counts[$capacity_label])) {
            $capacity_counts[$capacity_label] = 0;
            $capacities[] = $car['capacity'];
        }
        $capacity_counts[$capacity_label]++;
    }
}

// Sort categories and capacities
sort($categories);
sort($capacities);

// Get reviews for featured car
$reviews = [];
if ($featured_car) {
    $review_query = "SELECT * FROM reviews WHERE car_id = {$featured_car['id']} ORDER BY created_at DESC LIMIT 3";
    $review_result = mysqli_query($conn, $review_query);
    while ($review = mysqli_fetch_assoc($review_result)) {
        $reviews[] = $review;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Offer - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3563E9;
            --primary-light: #EFF4FF;
            --text-dark: #1A202C;
            --text-gray: #596780;
            --text-light: #90A3BF;
            --border-color: #E5E7EB;
            --bg-light: #F6F7F9;
            --white: #FFFFFF;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        body { background: #f7f9fb; }
        .sidebar {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            min-width: 220px;
        }
        .filter-title { font-weight: 600; margin-top: 24px; margin-bottom: 8px; font-size: 1.05rem; }
        .form-check-label { display: flex; justify-content: space-between; width: 100%; }
        .filter-count { color: #2563eb; font-weight: 600; }
        .form-range { accent-color: #2563eb; }
        .price-label { font-size: 0.95rem; color: #2563eb; font-weight: 600; }
        .featured-section {
            display: flex;
            gap: 32px;
            margin-bottom: 32px;
        }
        .featured-left {
            background: linear-gradient(135deg, #2563eb 80%, #1e40af 100%);
            color: #fff;
            border-radius: 18px;
            padding: 32px 24px;
            width: 370px;
            min-width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .featured-left h5 { font-weight: 700; font-size: 1.2rem; margin-bottom: 10px; }
        .featured-left p { font-size: 0.98rem; margin-bottom: 18px; }
        .featured-car-img {
            width: 260px;
            height: 120px;
            object-fit: contain;
            background: #fff;
            border-radius: 12px;
            margin-bottom: 18px;
        }
        .featured-gallery {
            display: flex;
            gap: 8px;
        }
        .featured-gallery img {
            width: 56px;
            height: 38px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #eaeaea;
            background: #fff;
        }
        .featured-right {
            background: #fff;
            border-radius: 18px;
            padding: 32px 28px 24px 28px;
            flex: 1;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .featured-title-row { display: flex; align-items: center; gap: 10px; }
        .featured-title-row .fa-heart { color: #e11d48; font-size: 1.3rem; margin-left: auto; cursor: pointer; }
        .featured-right h3 { font-weight: 700; font-size: 1.5rem; margin-bottom: 2px; }
        .featured-rating { color: #fbbf24; font-weight: 600; font-size: 1.05rem; }
        .featured-details-table { font-size: 0.98rem; margin: 10px 0 18px 0; }
        .featured-details-table td { padding: 2px 12px 2px 0; }
        .featured-price-row { display: flex; align-items: center; gap: 12px; margin: 18px 0 10px 0; }
        .featured-price { font-size: 1.6rem; font-weight: 700; color: #2563eb; }
        .featured-old-price { text-decoration: line-through; color: #aaa; font-size: 1.1rem; }
        .featured-rent-btn { margin-left: auto; font-weight: 600; }
        .reviews-section { margin-top: 18px; }
        .review-title-row { display: flex; align-items: center; gap: 8px; }
        .review-badge { background: #e0e7ff; color: #2563eb; font-weight: 600; font-size: 0.95rem; border-radius: 8px; padding: 2px 8px; }
        .review-item {
            display: flex;
            gap: 14px;
            background: #f4f6fa;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 10px;
        }
        .review-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: #e0e7ff;
        }
        .review-content { flex: 1; }
        .review-name { font-weight: 600; font-size: 1.05rem; }
        .review-date { color: #888; font-size: 0.92rem; margin-left: 8px; }
        .review-stars { color: #fbbf24; font-size: 1.05rem; }
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 32px 0 16px;
        }
        .car-card {
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            background: #fff;
            margin-bottom: 24px;
            position: relative;
            transition: box-shadow 0.2s;
        }
        .car-card:hover { box-shadow: 0 4px 16px rgba(37,99,235,0.10); }
        .car-card .car-image { height: 100px; object-fit: contain; background: #f4f6fa; border-radius: 12px; }
        .car-card .category-badge { font-size: 0.85rem; background: #e0e7ff; color: #2563eb; font-weight: 600; border-radius: 6px; margin-bottom: 4px; }
        .car-card .fa-heart { position: absolute; top: 16px; right: 18px; color: #e11d48; font-size: 1.1rem; cursor: pointer; }
        .car-card .btn { font-size: 0.95rem; font-weight: 600; }
        .car-card .car-features { font-size: 0.95rem; gap: 10px; margin-bottom: 6px; }
        .car-card .car-feature { gap: 4px; }
        .car-card .price-tag { font-size: 1.1rem; color: #2563eb; font-weight: 700; }
        .car-card .old-price { font-size: 0.95rem; color: #aaa; text-decoration: line-through; margin-left: 6px; }
        @media (max-width: 991px) {
            .featured-section { flex-direction: column; gap: 18px; }
            .featured-left { width: 100%; min-width: unset; }
        }
    </style>
</head>
<body>
<?php include '../includes/header.php'; ?>
<div class="container-fluid py-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="sidebar sticky-top" style="top: 20px;">
                <h5 class="mb-4">Filter By</h5>
                
                <!-- Search Box -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Search</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search car...">
                </div>
                
                <!-- Type Filter -->
                <div class="mb-4">
                    <div class="filter-title">Type</div>
                    <?php foreach ($categories as $category): 
                        $count = $category_counts[$category] ?? 0;
                        if ($count > 0): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" 
                                       id="type_<?php echo strtolower(str_replace(' ', '_', $category)); ?>" 
                                       data-filter="type" 
                                       value="<?php echo htmlspecialchars($category); ?>">
                                <label class="form-check-label" for="type_<?php echo strtolower(str_replace(' ', '_', $category)); ?>">
                                    <?php echo htmlspecialchars($category); ?> 
                                    <span class="filter-count">(<?php echo $count; ?>)</span>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
                <!-- Capacity Filter -->
                <div class="mb-4">
                    <div class="filter-title">Capacity</div>
                    <?php 
                    $capacity_labels = [];
                    foreach ($capacity_counts as $label => $count): 
                        if ($count > 0): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" 
                                       id="capacity_<?php echo preg_replace('/[^0-9]/', '', $label); ?>" 
                                       data-filter="capacity" 
                                       value="<?php echo preg_replace('/[^0-9]/', '', $label); ?>">
                                <label class="form-check-label" for="capacity_<?php echo preg_replace('/[^0-9]/', '', $label); ?>">
                                    <?php echo htmlspecialchars($label); ?>
                                    <span class="filter-count">(<?php echo $count; ?>)</span>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
                <!-- Price Range -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="filter-title">Price Range</span>
                        <span class="price-label" id="priceRangeValue">$0 - $1000</span>
                    </div>
                    <input type="range" class="form-range" min="0" max="1000" step="10" id="priceRange">
                    <div class="d-flex justify-content-between">
                        <small>$0</small>
                        <small>$1000</small>
                    </div>
                </div>
                
                <!-- Reset Filters Button -->
                <button class="btn btn-outline-primary w-100 mt-3" id="resetFilters">
                    <i class="fas fa-sync-alt me-2"></i>Reset Filters
                </button>
                <div class="filter-title">Price</div>
                <label for="priceRange" class="form-label price-label">Max. $100.00</label>
                <input type="range" class="form-range" min="0" max="100" id="priceRange">
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Featured Car Section -->
            <?php if ($featured_car): ?>
            <div class="featured-section">
                <div class="featured-left">
                    <h5><?php echo htmlspecialchars($featured_car['brand_name'] . ' ' . $featured_car['model']); ?></h5>
                    <p><?php echo htmlspecialchars($featured_car['short_description'] ?? 'Luxury and performance combined in this amazing vehicle'); ?></p>
                    <img src="<?php echo htmlspecialchars($featured_car['image_url'] ?? 'https://via.placeholder.com/400x200?text=Car+Image'); ?>" 
                         alt="<?php echo htmlspecialchars($featured_car['brand_name'] . ' ' . $featured_car['model']); ?>" 
                         class="featured-car-img">
                    <div class="featured-gallery">
                        <?php 
                        $gallery_images = !empty($featured_car['gallery_images']) ? explode(',', $featured_car['gallery_images']) : [];
                        $gallery_images = array_slice($gallery_images, 0, 3);
                        foreach ($gallery_images as $img): 
                            if (!empty(trim($img))): ?>
                                <img src="<?php echo htmlspecialchars(trim($img)); ?>" alt="Car Thumbnail">
                            <?php endif; 
                        endforeach; 
                        // Fill remaining spots with placeholder if needed
                        for ($i = count($gallery_images); $i < 3; $i++): ?>
                            <img src="https://via.placeholder.com/100x60?text=Image+<?php echo $i+1; ?>" alt="Car Thumbnail">
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="featured-right">
                    <div class="featured-title-row">
                        <h3><?php echo htmlspecialchars($featured_car['brand_name'] . ' ' . $featured_car['model']); ?></h3>
                        <i class="fas fa-heart" id="favoriteBtn" data-car-id="<?php echo $featured_car['id']; ?>"></i>
                    </div>
                    <div class="featured-rating">
                        <?php 
                        $avg_rating = number_format((float)$featured_car['avg_rating'], 1);
                        $review_count = $featured_car['review_count'];
                        for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i <= round($avg_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                        <?php endfor; ?>
                        <span class="text-muted">(<?php echo $avg_rating; ?>/5 from <?php echo $review_count; ?> reviews)</span>
                    </div>
                    <p class="text-muted mt-2"><?php echo htmlspecialchars($featured_car['description'] ?? 'No description available.'); ?></p>
                    <table class="featured-details-table">
                        <tr>
                            <td><i class="fas fa-tachometer-alt me-2"></i> <?php echo htmlspecialchars($featured_car['acceleration'] ?? 'N/A'); ?>s</td>
                            <td><i class="fas fa-gas-pump me-2"></i> <?php echo htmlspecialchars($featured_car['fuel_economy'] ?? 'N/A'); ?>L/100km</td>
                            <td><i class="fas fa-cog me-2"></i> <?php echo htmlspecialchars($featured_car['transmission'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td>0-100 km/h</td>
                            <td>Fuel Economy</td>
                            <td>Transmission</td>
                        </tr>
                    </table>
                    <div class="featured-price-row">
                        <div>
                            <div class="featured-price">$<?php echo number_format($featured_car['price_per_day'] ?? 0, 2); ?>
                                <?php if (isset($featured_car['original_price']) && $featured_car['original_price'] > $featured_car['price_per_day']): ?>
                                    <span class="featured-old-price ms-2">$<?php echo number_format($featured_car['original_price'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-success small">+ $<?php echo number_format($featured_car['shipping_fee'] ?? 5.00, 2); ?> shipping fee</div>
                        </div>
                        <a href="booking.php?car_id=<?php echo $featured_car['id']; ?>" class="btn btn-primary featured-rent-btn">
                            Rent Now
                        </a>
                    </div>
                    <?php if (!empty($reviews)): ?>
                    <div class="reviews-section">
                        <div class="review-title-row mb-2">
                                    </div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary"><?php echo htmlspecialchars($car['category'] ?? 'Car'); ?></span>
                                </div>
                                
                                <div class="car-features d-flex flex-wrap mb-3">
                                    <div class="car-feature d-flex align-items-center me-3 mb-2">
                                        <i class="fas fa-user-friends text-muted me-1"></i>
                                        <small><?php echo $car['capacity'] ?? 4; ?> People</small>
                                    </div>
                                    <div class="car-feature d-flex align-items-center me-3 mb-2">
                                        <i class="fas fa-gas-pump text-muted me-1"></i>
                                        <small><?php echo $car['fuel_type'] ?? 'Petrol'; ?></small>
                                    </div>
                                    <div class="car-feature d-flex align-items-center me-3 mb-2">
                                        <i class="fas fa-tachometer-alt text-muted me-1"></i>
                                        <small><?php echo $car['transmission'] ?? 'Automatic'; ?></small>
                                    </div>
                                    <div class="car-feature d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                                        <small><?php echo $car['year'] ?? 'N/A'; ?></small>
                                    </div>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="year_desc">Newest First</option>
                        <option value="year_asc">Oldest First</option>
                        <option value="rating_desc">Highest Rated</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="carsContainer">
                <?php 
                // Filter out the featured car from the list
                $filtered_cars = array_filter($cars, function($car) use ($featured_car) {
                    return !$featured_car || $car['id'] != $featured_car['id'];
                });
                
                foreach (array_slice($filtered_cars, 0, 6) as $car): 
                    $is_featured = $featured_car && $car['id'] == $featured_car['id'];
                    if ($is_featured) continue; // Skip featured car in the grid
                    
                    $avg_rating = number_format((float)($car['avg_rating'] ?? 0), 1);
                    $review_count = $car['review_count'] ?? 0;
                    $price_per_day = number_format($car['price_per_day'] ?? 0, 2);
                    $original_price = isset($car['original_price']) ? number_format($car['original_price'], 2) : null;
                ?>
                <div class="col-md-6 col-lg-4 mb-4 car-item" 
                     data-category="<?php echo htmlspecialchars(strtolower($car['category'] ?? '')); ?>"
                     data-capacity="<?php echo (int)($car['capacity'] ?? 0); ?>"
                     data-price="<?php echo (float)($car['price_per_day'] ?? 0); ?>"
                     data-year="<?php echo (int)($car['year'] ?? 0); ?>"
                     data-rating="<?php echo $avg_rating; ?>">
                    <div class="card car-card h-100">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($car['image_url'] ?? 'https://via.placeholder.com/400x200?text=Car+Image'); ?>" 
                                 class="card-img-top car-image p-3" 
                                 alt="<?php echo htmlspecialchars(($car['brand_name'] ?? '') . ' ' . ($car['model'] ?? '')); ?>">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button class="btn btn-sm btn-light rounded-circle p-2 favorite-btn" data-car-id="<?php echo $car['id']; ?>">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <?php if (isset($car['original_price']) && $car['price_per_day'] < $car['original_price']): ?>
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-danger">Save $<?php echo number_format($car['original_price'] - $car['price_per_day'], 2); ?></span>
                                </div>
                            <?php endif; ?>
                        <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top car-image" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                        <div class="card-body">
                            <span class="badge category-badge mb-1"><?php echo htmlspecialchars($car['category']); ?></span>
                            <h5 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h5>
                            <div class="car-features mb-2">
                                <span class="car-feature"><i class="fas fa-users"></i> <?php echo htmlspecialchars($car['capacity']); ?></span>
                                <span class="car-feature"><i class="fas fa-cog"></i> <?php echo htmlspecialchars($car['transmission']); ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="price-tag">$<?php echo number_format($car['price'], 2); ?></span>
                                <?php if ($car['original_price']) { ?>
                                <span class="old-price">$<?php echo number_format($car['original_price'], 2); ?></span>
                                <?php } ?>
                            </div>
                            <a href="reservation.php?car_id=<?php echo $car['id']; ?>" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- Recommendation Cars -->
            <div class="d-flex justify-content-between align-items-center section-title">
                <span>Recommendation Car</span>
                <a href="#" class="small">View All</a>
            </div>
            <div class="row">
                <?php foreach (array_slice($cars, 3, 3) as $car) { ?>
                <div class="col-md-4">
                    <div class="card car-card">
                        <i class="fa fa-heart"></i>
                        <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top car-image" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                        <div class="card-body">
                            <span class="badge category-badge mb-1"><?php echo htmlspecialchars($car['category']); ?></span>
                            <h5 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h5>
                            <div class="car-features mb-2">
                                <span class="car-feature"><i class="fas fa-users"></i> <?php echo htmlspecialchars($car['capacity']); ?></span>
                                <span class="car-feature"><i class="fas fa-cog"></i> <?php echo htmlspecialchars($car['transmission']); ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="price-tag">$<?php echo number_format($car['price'], 2); ?></span>
                                <?php if ($car['original_price']) { ?>
                                <span class="old-price">$<?php echo number_format($car['original_price'], 2); ?></span>
                                <?php } ?>
                            </div>
                            <a href="reservation.php?car_id=<?php echo $car['id']; ?>" class="btn btn-primary w-100">Rent Now</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    const priceRange = document.getElementById('priceRange');
    const priceRangeValue = document.getElementById('priceRangeValue');
    
    if (priceRange && priceRangeValue) {
        priceRange.addEventListener('input', function() {
            priceRangeValue.textContent = `$${this.value}`;
            filterCars();
        });
    }

    // Filter checkboxes
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterCars);
    });

    // Search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(filterCars, 300));
    }

    // Sort select
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', sortCars);
    }

    // Reset filters button
    const resetFiltersBtn = document.getElementById('resetFilters');
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', resetFilters);
    }

    // Load more button
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMoreCars);
    }

    // Favorite buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.favorite-btn, #favoriteBtn')) {
            e.preventDefault();
            const btn = e.target.closest('.favorite-btn, #favoriteBtn');
            const carId = btn.dataset.carId;
            toggleFavorite(btn, carId);
        }
    });

    // Filter cars based on selected filters
    function filterCars() {
        const searchTerm = searchInput.value.toLowerCase();
        const maxPrice = parseFloat(priceRange.value) || 1000;
        
        // Get selected categories
        const selectedCategories = [];
        document.querySelectorAll('input[data-filter="type"]:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.value.toLowerCase());
        });
        
        // Get selected capacities
        const selectedCapacities = [];
        document.querySelectorAll('input[data-filter="capacity"]:checked').forEach(checkbox => {
            selectedCapacities.push(parseInt(checkbox.value));
        });

        let visibleCount = 0;
        const carItems = document.querySelectorAll('.car-item');
        
        carItems.forEach(item => {
            const carName = item.querySelector('.card-title')?.textContent?.toLowerCase() || '';
            const carCategory = item.dataset.category || '';
            const carCapacity = parseInt(item.dataset.capacity) || 0;
            const carPrice = parseFloat(item.dataset.price) || 0;
            
            // Apply filters
            const matchesSearch = carName.includes(searchTerm);
            const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(carCategory);
            const matchesCapacity = selectedCapacities.length === 0 || selectedCapacities.includes(carCapacity);
            const matchesPrice = carPrice <= maxPrice;
            
            if (matchesSearch && matchesCategory && matchesCapacity && matchesPrice) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }

    // Sort cars based on selected option
    function sortCars() {
        const sortBy = sortSelect.value;
        const container = document.getElementById('carsContainer');
        const items = Array.from(container.getElementsByClassName('car-item'));

        items.sort((a, b) => {
            switch(sortBy) {
                case 'price_asc':
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                case 'price_desc':
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                case 'year_desc':
                    return parseInt(b.dataset.year) - parseInt(a.dataset.year);
                case 'year_asc':
                    return parseInt(a.dataset.year) - parseInt(b.dataset.year);
                case 'rating_desc':
                    return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                default:
                    return 0;
            }
        });

        // Re-append items in new order
        items.forEach(item => container.appendChild(item));
    }

    // Reset all filters
    function resetFilters() {
        // Reset checkboxes
        filterCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Reset price range
        if (priceRange) {
            priceRange.value = 1000;
            priceRangeValue.textContent = '$1000';
        }
        
        // Reset search
        if (searchInput) {
            searchInput.value = '';
        }
        
        // Reset sort
        if (sortSelect) {
            sortSelect.value = 'price_asc';
        }
        
        // Show all cars
        document.querySelectorAll('.car-item').forEach(item => {
            item.style.display = '';
        });
    }

    // Load more cars (simulated - in a real app, this would fetch more from the server)
    function loadMoreCars() {
        // This is a simplified example. In a real app, you would fetch more cars from the server
        const hiddenCars = document.querySelectorAll('.car-item[style*="display: none"]');
        const toShow = Math.min(3, hiddenCars.length);
        
        for (let i = 0; i < toShow; i++) {
            hiddenCars[i].style.display = '';
        }
        
        // Hide load more button if no more hidden cars
        if (hiddenCars.length <= toShow && loadMoreBtn) {
            loadMoreBtn.style.display = 'none';
        }
    }

    // Toggle favorite status
    function toggleFavorite(btn, carId) {
        // In a real app, this would make an AJAX call to the server
        const icon = btn.querySelector('i');
        const isFavorite = icon.classList.contains('fas');
        
        if (isFavorite) {
            icon.classList.remove('fas', 'text-danger');
            icon.classList.add('far');
        } else {
            icon.classList.remove('far');
            icon.classList.add('fas', 'text-danger');
        }
        
        // Show feedback
        const toast = new bootstrap.Toast(document.getElementById('favoriteToast'));
        const toastMessage = document.getElementById('toastMessage');
        if (toastMessage) {
            toastMessage.textContent = isFavorite ? 'Removed from favorites' : 'Added to favorites';
            toast.show();
        }
    }

    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
</script>

<!-- Toast for favorite feedback -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="favoriteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Car Rental</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage">
            Added to favorites
        </div>
    </div>
</div>

</body>
</html> 